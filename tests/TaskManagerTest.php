<?php

namespace Vendor\UnitTesting\tests;

use Vendor\UnitTesting\TaskManager;
use PHPUnit\Framework\TestCase;

class TaskManagerTest extends TestCase{
    public function testAddTask()   {
        $manager = new TaskManager();
        $manager->addTask("task n°1");
        $this->assertEquals("task n°1", $manager->getTask("0"));
    }
    public function testRemoveTask() {
        $manager = new TaskManager();
        
        $manager->addTask("task n°1");
        $manager->removeTask("0");
        $this->assertEquals([], $manager->getTasks() );
    }
    public function testGetTasks() {
        $manager = new TaskManager();
        $manager->addTask("test1");
        $manager->addTask("test2");
        $this->assertEquals(["test1","test2"], $manager->getTasks() );
    }
    public function testGetTask() {
        $manager = new TaskManager();
        $manager->addTask("task1");
        $this->assertEquals("task1", $manager->getTask("0"));
    }
    
    public function testRemoveInvalidIndexThrowsException()
    {
        $this->expectException(\OutOfBoundsException::class);

        $manager = new TaskManager();
        $manager->removeTask(0); // ✅ Doit lever une exception car aucune tâche n'existe à cet index
    }

    public function testGetInvalidIndexThrowsException()
    {
        $this->expectException(\OutOfBoundsException::class);

        $manager = new TaskManager();
        $manager->getTask(0); // ✅ Doit lever une exception car la liste est vide
    }

    public function testTaskOrderAfterRemoval()
    {
        $manager = new TaskManager();
        $manager->addTask("task 1");
        $manager->addTask("task 2");
        $manager->addTask("task 3");

        $manager->removeTask(1); // Supprime "task 2"

        $this->assertEquals(["task 1", "task 3"], $manager->getTasks()); // ✅ Vérifie que la liste est bien réindexée
    }
}


// testRemoveInvalidIndexThrowsException
// testGetInvalidIndexThrowsException
// testTaskOrderAfterRemoval
