<?php

namespace sudokuSolver;

/**
 * @author Lukáš Holeczy
 * @version 0.9
 *  
 */
class SudokuSolver {
 
    private $sudoku;
 
    function __construct($sudoku) {
        $this->sudoku = $sudoku;
    }
 
    /**
     * @param int line číslo řádku v tabulce sudoku
     * @param int column číslo sloupce v tabulce sudoku
     * @return bool
     * 
     */
    public function solve($line = 0, $column = 0) {
        
        if ($line >= 9) { // Pokud se dostaneme až sem, tak vuala, sudoku je vyřešeno
            return true;
        }
 
        if (!empty($this->sudoku[$line][$column])) { // Pokud buňka není prázdná, tak jdeme na další
            return $this->solve($line + ($column + 1 >= 9), ($column + 1) % 9); // Pokud už bylo sloupeček poslední, tak skočíme na další řádek, sloupeček posuneme
        }
 
        for ($number = 1; $number <= 9; $number++) { // Buňka je prázdná, postupně tam zkusíme čísla 1-9
            
            if ($this->isNewNumberValid($line, $column, $number)) { // Neporušuje nové číslo pravidla?

                $this->sudoku[$line][$column] = $number; // Zapíšeme číslo do buňky

                $solution = $this->solve($line + ($column + 1 >= 9), ($column + 1) % 9); // S daným číslem zkusíme vyřešit zbytek sudoku
                if ($solution !== false) { // Pokud řešení vyšlo, tak máme hotovo :)
                    return true;
                }

            }

        }
 
        $this->sudoku[$line][$column] = 0; // Žádné číslo nefungovalo, tak to zase smažem.. 

        return false; // A vrátíme se zpět k předchozí buňce
    }
 
    /**
     * @param int line
     * @param int number číslo k doplnění
     * @return bool
     */
    private function isValidInLine($line, $number) {
        return !in_array($number, $this->sudoku[$line]); // Obsahuje daný řádek číslo co chceme doplnit?
    }
 
    /**
     * @param int column
     * @param int number
     * @return bool
     */
    private function isValidInColumn($column, $number) {
        foreach ($this->sudoku as $lines) { // Projdeme daný sloupec ve všech řádcích a řekneme, zda se tam vyskytuje číslo, které chce doplnit
            if ($lines[$column] == $number) {
                return false;
            }
        }
 
        return true;
    }
 
    /**
     * @param int line
     * @param int column
     * @param int number
     * @return bool
     */
    private function isValidInBox($line, $column, $number) {
        $line -= $line % 3; // Přesuneme se na levý horní roh daného čtverce
        $column -= $column % 3;
 
        for ($l = $line; $l < $line + 3; $l++) { // Celý čtverec projdeme, zda číslo neobsahuje
            for ($c = $column; $c < $column + 3; $c++) {
                if ($number == $this->sudoku[$l][$c]) {
                    return false;
                }
            }
        }
 
        return true;
    }
 
    /**
     * @param int line
     * @param int column
     * @param int number
     * @return bool
     */
    private function isNewNumberValid($line, $column, $number) { // Zkontroluje řádek, sloupec a box, zda neodporuje dosazované číslo pravidlům (nevyskytovalo by se dvakrát)
        return $this->isValidInLine($line, $number)
            && $this->isValidInColumn($column, $number)
            && $this->isValidInBox($line, $column, $number);
    }
 
    /**
     * @return array
     */
    public function returnSudoku() {
        return $this->sudoku;    
    }
}