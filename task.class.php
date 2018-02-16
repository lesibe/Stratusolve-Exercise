<?php
/**
 * This class handles the modification of a task object
 */
class Task {
    public $TaskId;
    public $TaskName;
    public $TaskDescription;
    protected $TaskDataSource;
    public function __construct($Id = null) {
		
        $this->TaskDataSource = file_get_contents('Task_Data.txt');
        if (strlen($this->TaskDataSource) > 0)
            $this->TaskDataSource = json_decode($this->TaskDataSource); // Should decode to an array of Task objects
        else
            $this->TaskDataSource = array(); // If it does not, then the data source is assumed to be empty and we create an empty array
        if (!$this->TaskDataSource)
            $this->TaskDataSource = array(); // If it does not, then the data source is assumed to be empty and we create an empty array
        if (!$this->LoadFromId($Id))
            $this->Create();
    }
    protected function Create() {
        // This function needs to generate a new unique ID for the task
        // Assignment: Generate unique id for the new task
        $this->TaskId = $this->getUniqueId();
        $this->TaskName = 'New Task';
        $this->TaskDescription = 'New Description';
    }
    protected function getUniqueId() {
        // Assignment: Code to get new unique ID
		$max_leng = count($this->TaskDataSource);
		
		$last = end($this->TaskDataSource);
		
		$indexIs = $last->TaskId;
		
        return $indexIs + 1; // Placeholder return for now
    }
    protected function LoadFromId($Id) {
        if ($Id) {
            // Assignment: Code to load details here...
			return $this->getUniqueId();
        } else
            return null;
    }
    public function Save($currentTaskId, $InputTaskName, $InputTaskDescription) {
		
        //Assignment: Code to save task here
		$this->TaskId 			= $currentTaskId;
        $this->TaskName 		= $InputTaskName;
        $this->TaskDescription 	= $InputTaskDescription;
		
		if($currentTaskId == -1){
		
			$data = (object)array("TaskId" => $this->getUniqueId(), "TaskName" => $this->TaskName,"TaskDescription" => $this->TaskDescription);

			
			array_push($this->TaskDataSource, $data);

			$jsonData = json_encode($this->TaskDataSource);

			file_put_contents("Task_Data.txt",$jsonData);
			
			return $this->TaskName." Saved Successful";
		
		}else{
			
			$json = $this->TaskDataSource;
			
			foreach ($json as $key => $item) {
				if ($item->TaskId == $currentTaskId) {
					
					$item->TaskName			= $InputTaskName;
					$item->TaskDescription 	= $this->TaskDescription;
					
				}file_put_contents('Task_Data.txt', json_encode($json));
			}
			
			
			return $this->TaskName." Updated Successful";
			
		}
		
		
    }
    public function Delete($currentTaskId) {
        //Assignment: Code to delete task here
		//$this->TaskId = $currentTaskId;
		
		
		if($currentTaskId){

			$json = $this->TaskDataSource;
			

			foreach ($json as $key => $item) {
				if ($item->TaskId == $currentTaskId) {
					
					array_splice($json, $key,1);
					
					file_put_contents('Task_Data.txt', json_encode($json));
								
				}
			}
		}
		
		return "";		
    }
	
}

