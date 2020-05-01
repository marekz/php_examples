<?php

/**
 * Example of one-way list implementation
 */
class ListNode {
    public $data = null;
    public $next = null;
    
    public function __construct(string $data = null) {
        $this->data = $data;
    }
}


class LinkedList {
    private $_firstNode = null;
    private $_totalNode = 0;
    
    public function insert(string $data = null) {
        $newNode = new ListNode($data);
        
        if ($this->_firstNode === null) {
            $this->_firstNode = &$newNode;
        } else {
            $currentNode = $this->_firstNode;
            while ($currentNode->next !== null) {
                $currentNode = $currentNode->next;
            }
            $currentNode->next = $newNode;
        }
        $this->_totalNode++;
        return true;
     }
     
     public function display() {
         echo "Wszystkich elementów na liście: " . $this->_totalNode."\n";
         $currentNode = $this->_firstNode;
         while ($currentNode !== null) {
             echo $currentNode->data . "\n";
             $currentNode = $currentNode->next;
         }
     }
}


$newLinkedList = new LinkedList();

$newLinkedList->insert("Litwo! Ojczyzno moja");
$newLinkedList->insert("Ty jesteś jak zdrowie");
$newLinkedList->insert("Ile Cię cenić trzeba ten tylko się dowie");
$newLinkedList->insert("Kto Cię stracił!");
$newLinkedList->insert("Dziś piękno po tobie widzę i opisuję");
$newLinkedList->insert("Bo tęsknię po tobie");


$newLinkedList->display();