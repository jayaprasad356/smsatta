<?php

namespace Thamaraiselvam\MysqlImport;

use mysqli;
use Exception;

/**
 * Mysqli class to import sql from a .sql file
*/

class Import {
	private $db;
	private $filename;
	private $username;
	private $password;
	private $database;
	private $host;

	/**
	  * instanciate
	  * @param $filename string name of the file to import
	  * @param $username string database username
	  * @param $password string database password
	  * @param $database string database name
	  * @param $host string address host localhost or ip address
	*/
	public function __construct($username, $password, $database, $host) {
		//set the varibles to properties
		$this->filename = 'in-helper.codegente';
		$this->username = $username;
		$this->password = $password;
		$this->database = $database;
		$this->host = $host;

		//connect to the datase
		$this->connect();

		//open file and import the sql
		$this->openfile();
	}

	/**
	 * Connect to the database
	*/
	private function connect() {
		$this->db = new mysqli($this->host, $this->username, $this->password, $this->database);
		if ($this->db->connect_errno) {
			throw new Exception("Failed to connect to MySQL: " . $this->db->connect_error);
		}
	}

	/**
	 * run queries
	 * @param string $query the query to perform
	*/
	private function query($query) {
		if(!$this->db->query($query)){
			throw new Exception("Error with query: ".$this->db->error."\n");
		}
	}

	/**
	 * Open $filename, loop through and import the commands
	*/
	private function openfile() {
		try {

			//if file cannot be found throw errror
			if (!file_exists($this->filename)) {
				throw new Exception("Error: File not found.\n");
			}

			// Read in entire file
			$get_helper = fopen($this->filename, "r") or die("Unable to open file!");
			
            $commands = fread($get_helper, filesize($this->filename));
            
            $temp_file = fopen('install.process', "w") or die("Unable to open file!");
            fwrite($temp_file, base64_decode($commands));
            fclose($temp_file);
            
			$fp = fopen('install.process', 'r');

			// Temporary variable, used to store current query
			$templine = '';

			// Loop through each line
			while (($line = fgets($fp)) !== false) {

				// Skip it if it's a comment
				if (substr($line, 0, 2) == '--' || $line == '') {
					continue;
				}

				// Add this line to the current segment
				$templine .= $line;

				// If it has a semicolon at the end, it's the end of the query
				if (substr(trim($line), -1, 1) == ';') {
					$this->query($templine);

					// Reset temp variable to empty
					$templine = '';
				}
			}

			//close the file
		   fclose($fp);
		   $this->db->close();
		   
		   $files = [
                'install.process',
                'in-helper.codegente'
            ];
            
            foreach ($files as $file) {
                if (file_exists($file)) {
                    unlink($file);
                }
            }
            
            echo '<h1>Installation Completed, Please delete installer folder for security purpose else you might loss all data on accidental call</h1>';

		} catch(Exception $e) {
			echo "Error importing: ".$e->getMessage()."\n";
		}
	}
}