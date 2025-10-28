<?php
// app/controllers/TestController.php

class TestController {
    
    public function database() {
        echo "<h1>Database Connection Test</h1>";
        
        // Test DB class
        echo "<h2>Testing DB Connection</h2>";
        try {
            $result = DB::query("SELECT 1 as test");
            if ($result) {
                echo "✅ DB Connection: SUCCESS<br>";
                $row = $result->fetch_assoc();
                echo "Test query result: " . $row['test'] . "<br>";
                
                // Test if tables exist
                echo "<h2>Checking Database Tables</h2>";
                $tables = DB::query("SHOW TABLES");
                if ($tables && $tables->num_rows > 0) {
                    echo "✅ Tables found: " . $tables->num_rows . "<br>";
                    while ($table = $tables->fetch_array()) {
                        echo "- " . $table[0] . "<br>";
                    }
                } else {
                    echo "⚠️ No tables found<br>";
                }
            } else {
                echo "❌ DB Connection: FAILED - " . DB::getError() . "<br>";
            }
        } catch (Exception $e) {
            echo "❌ DB Connection: ERROR - " . $e->getMessage() . "<br>";
        }
        
        echo "<hr><a href='/setup'>Run Database Setup</a> | <a href='/'>Go Home</a>";
    }
}
