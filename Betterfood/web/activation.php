<?php
require_once 'db_config.php';
$status = 0;

                if (isset($_GET['activation_code'])) {
                    $activation_code = $_GET['activation_code'];
                    $active = "1";
                    $sql = "SELECT verification FROM profiles ";
                    if ($result = $connect -> query($sql)) {
                        while ($row = $result -> fetch_assoc()) {
                            if($activation_code == $row['verification']){
                                $sql = "UPDATE profiles SET activation='$active' WHERE verification='$activation_code'";
                                if ($connect->query($sql) === TRUE) {
                                    header("Location:profile.php?activation=1");
                                    $status = 1;
                                  } else {
                                    $status = 0;
                                  }
                               
                            }
                        }
                }
            }
                else if($status == 0) {
                    header("Location:profile.php?activation=2");
                }
?>