<?php

namespace App\TenantDatabaseManagers;

use Illuminate\Database\Connection;
use Illuminate\Support\Facades\DB;
use Stancl\Tenancy\Contracts\TenantDatabaseManager;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Exceptions\NoConnectionSetException;
use Tenancy\Identification\Contracts\Tenant;

class SqlServerDatabaseManager implements TenantDatabaseManager
{
    /** @var string */
    protected $connection;

    protected function database(): Connection
    {
        if ($this->connection === null) {
            throw new NoConnectionSetException(static::class);
        }

        return DB::connection($this->connection);
    }

    public function setConnection(string $connection): void
    {
        $this->connection = $connection;
    }

    public function createDatabase(TenantWithDatabase $tenant): bool
    {
        // Implementa la lógica para crear una base de datos en SQL Server
         return $this->database()->statement("CREATE DATABASE [{$tenant->database()->getName()}]");
//         TODO: implement user controll system
        /*$this->processInMain([
            'login'    => "CREATE LOGIN {$config['username']} WITH PASSWORD = '{$config['password']}'",
            'database' => "CREATE DATABASE {$config['database']}",
        ]);

        return $this->processAndDispatch(Events\Created::class, $tenant, [
            'user'     => "CREATE USER {$config['username']} FOR LOGIN {$config['username']} WITH DEFAULT_SCHEMA = dbo",
            'grant'    => "GRANT CONTROL ON DATABASE::{$config['database']} TO {$config['username']}",
        ]);*/
    }

    public function deleteDatabase(TenantWithDatabase $tenant): bool
    {
        // Implementa la lógica para eliminar una base de datos en SQL Server
        // Por ejemplo:
         return $this->database()->statement("DROP DATABASE [{$tenant->database()->getName()}]");
         // TODO manage permissions
    }

    public function databaseExists(string $name): bool
    {
        // Implementa la lógica para verificar si una base de datos existe en SQL Server
        // Por ejemplo:
         return (bool) $this->database()->select("SELECT name FROM sys.databases WHERE name = '$name'");
    }

    public function makeConnectionConfig(array $baseConfig, string $databaseName): array
    {
        $baseConfig['database'] = $databaseName;

        // Puedes personalizar otras opciones de configuración aquí si es necesario

        return $baseConfig;
    }

    // custom methos
    protected function processInMain(array $statements): bool
    {
        $success = false;

        foreach ($statements as $statement) {
            try {
                $success = DB::connection(self::$defaultConnection)->statement($statement);
                // @codeCoverageIgnoreStart
            } /*catch (QueryException $e) {
                DB::connection(self::$defaultConnection)->rollBack();
                // @codeCoverageIgnoreEnd
            }*/ catch (\Exception $e) {
                // DB::connection(self::$defaultConnection)->rollBack();
            } finally {
                if (!$success) {
                    throw $e;
                }
            }
        }

        return $success;
    }

    /**
     * Processes the provided statements and dispatches an event.
     *
     * @param string $event
     * @param Tenant $tenant
     * @param array  $statements
     *
     * @return bool
     */
    private function processAndDispatch(string $event, Tenant $tenant, array $statements)
    {
        $result = $this->process($tenant, $statements);

        event((new $event($tenant, $this, $result)));

        return $result;
    }
}
