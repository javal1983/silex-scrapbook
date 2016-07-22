<?php

ini_set('display_errors', 1);
ini_set('track_errors', 1);
ini_set('html_errors', 1);
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of foodora
 *
 * @author javal.patel<javalpatel@gmail.com>
 */
class foodora {
    # @array,  The database settings

    private $settings;

    # @object, The Database Connection object
    private $dbConnection;

    /**
     *  Default Constructor 
     * 	1. Connect to database.
     * 	2. Creates the parameter array.
     */
    public function __construct() {
        $this->Connect();
    }

    public function __destruct() {
       $this->dbConnection->close(); 
    }

    /**
     * 	This method makes connection to the database.
     * 	
     * 	1. Reads the database settings from a ini file. 
     * 	2. Puts  the ini content into the settings array.
     * 	3. Tries to connect to the database.
     * 	4. If connection failed, exception is displayed.
     */
    private function Connect() {
        $this->settings = parse_ini_file(__DIR__ . "/settings.ini");
        $this->dbConnection = new mysqli($this->settings["host"], $this->settings["user"], $this->settings["password"], $this->settings["dbname"]);

        // Check connection
        if ($this->dbConnection->connect_error) {
            echo "Failed to connect to MySQL: " . $this->dbConnection->connect_error;
            exit();
        }
    }

    /**
     *  @void
     * 
     * 	This method generate sql dump of table.
     * 	@param string $tableName
     */
    public function ExportDataTable($tableName) {
        $backupFile = __DIR__ . "/dump/" . $tableName . ".sql";
        if (!file_exists($backupFile)) {
            $sql = "SELECT * INTO OUTFILE '$backupFile' FROM $tableName";
            if ($this->dbConnection->query($sql) === TRUE) {
                return TRUE;
            } else {
                echo "Failed to connect to MySQL: " . $this->dbConnection->error;
                exit;
            }
        }
    }

    /**
     *  @void
     * 
     * 	This method Import sql dump to table.
     * 	@param string $tableName
     */
    public function ImportDataTable($tableName) {
        $importFile = __DIR__ . "/dump/" . $tableName . ".sql";
        $sql = "LOAD DATA INFILE '$importFile' INTO TABLE $tableName";
        if ($this->dbConnection->query($sql) === TRUE) {
            return TRUE;
        } else {
            echo "Failed to connect to MySQL: " . $this->dbConnection->error;
            exit;
        }
    }

    /**
     *  @void
     * 
     * 	This method get All Data form Table.
     * 	@param string $tableName
     */
    public function GetAllDataTable($tableName) {
        $finalResult = array();
        $sql = "SELECT * FROM $tableName";
        $result = $this->dbConnection->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            $finalResult = mysqli_fetch_all($result,MYSQLI_ASSOC);
        }
        return $finalResult;
    }
    

    /**
     *  @void
     * 
     * 	This method will Data form Table.
     * 	@param string $tableName
     * 	@param string $whereCondition : if null will truncate table
     */
    public function DeleteDataFromTable($tableName,$whereCondition = '') {
        if($whereCondition != ''){
            $sql = "DELETE FROM $tableName WHERE $whereCondition";
        }else{
            $sql = "TRUNCATE TABLE $tableName";
        }
        if ($this->dbConnection->query($sql) === TRUE) {
            return TRUE;
        } else {
            echo "Failed to connect to MySQL: " . $this->dbConnection->error;
            exit;
        }
    }

    /**
     *  @void
     * 
     * 	This method will Data form Table.
     * 	@param string $sql
     */
    public function ExecuteQuery($sql) {
        if ($this->dbConnection->query($sql) === TRUE) {
            return TRUE;
        } else {
            echo "Failed to connect to MySQL: " . $this->dbConnection->error;
            exit;
        }
    }
    
    

}
