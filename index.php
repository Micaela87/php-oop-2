<?php
    /**
     * 
     *      Definire classe Persona:
     *          - ATTRIBUTI (private):
     *              - nome
     *              - cognome
     *              - dataNascita (stringa)
     *          - METODI:
     *              - costruttore che accetta nome e cognome
     *              - setter/getter per ogni variabile
     *              - printFullPerson: che stampa "nome cognome: dataNascita"
     *              - toString: che ritorna "nome cognome: dataNascita"
     * 
     * 
     *      Definire classe Employee che eredita da Persona:
     *          - ATTRIBUTI (private):
     *              - stipendio
     *              - dataAssunzione
     *          - METODI:
     *              - costruttore che accetta nome, cognome e stipendio
     *              - setter/getter per variabili 
     *              - printFullEmployee: che stampa "nome cognome: stipendio (dataAssunzione)"
     *              - toString: che ritorna "nome cognome: stipendio (dataAssunzione)"
     * 
     */

     class Persona {
         private $nome, $cognome, $dataNascita;

         static $dateFormat = 'd/m/Y';

         function __construct($nome, $cognome) {
            $this -> setName($nome);
            $this -> setSurname($cognome);
         }

         static function validateDate($date, $format) {
            $d = DateTime::createFromFormat($format, $date);
            return $d && $d->format($format) == $date;
        }

         function getName() {
             return $this -> nome;
         }

         function setName($nome) {
            if (gettype($nome) === 'string') {
                $nameToLower = strtolower($nome);
                $this -> nome = ucfirst($nameToLower);
            }
            
        }

         function getSurname() {
             return $this -> cognome;
         }

         function setSurname($cognome) {
            if (gettype($cognome) === 'string') {
                $surnameToLower = strtolower($cognome);
                $this -> cognome = ucfirst($surnameToLower);
            }
        }

        function getBirthDate() {
            return $this -> dataNascita;
            
        }

        function setBirthDate($dataNascita) {
            
            if ($this -> validateDate($dataNascita, Persona::$dateFormat)) {
                $this -> dataNascita = $dataNascita;
            }
            
        }

        function printFullPerson() {
            return $this -> getName() . " " . $this -> getSurname() . " : " . $this -> getBirthDate();
        }

        function __toString() {
            return $this -> printFullPerson();
        }
     }

     class Employee extends Persona {
         private $stipendio, $dataAssunzione;

         function __construct($nome, $cognome, $stipendio) {
             parent::__construct($nome, $cognome);
             $this -> setSalary($stipendio);
         }

         function getSalary() {
             return $this -> stipendio;
         }

         function setSalary($stipendio) {
             if (gettype($stipendio) === 'integer' && strlen((string)$stipendio) >= 3)
             $this -> stipendio = $stipendio;
         }

         function getRecruitmentDate() {
             return $this -> dataAssunzione;
         }

         function setRecruitmentDate($dataAssunzione) {
            if (parent::validateDate($dataAssunzione, parent::$dateFormat)) {
                $this -> dataAssunzione = $dataAssunzione;
            }
            
        }

        function printFullEmployee() {
            return $this -> getName() . " " . $this -> getSurname() . " : " . $this -> getSalary() . " (" . $this -> getRecruitmentDate() . ")";
        }

        function __toString() {
            return $this -> printFullEmployee();
        }
     }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
     <?php

        $p1 = new Persona("MICAELA", "MILANO");
        $p1 -> setBirthDate("25/04/1987");

        $emp1 = new Employee("MARCELLO", "rossi", 200);
        $emp1 -> setRecruitmentDate("11/01/2001");

        echo $p1 . "<br>" . $emp1;

     ?>

</body>
</html>