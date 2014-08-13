<?php 

class items
{
	private $id = NULL ;
	private $name = NULL ;
	private $description = NULL ;
	private $price = NULL ;

	public setId ( $myId){
			$id = $myId;
	}
	
	public getId ( $id){
			return $id;
	}
	
	public setName ( $myName){
			$name = $myName;
	}
	
	public getName ( $name){
			return $name;
	}
	
	public setDescription ( $myDescription){
			$description = $myDescription;
	}
	
	public getDescription ( $description){
			return $description;
	}
	
	public setPrice ( $myPrice){
			$price = $myPrice;
	}
	
	public getPrice ( $price){
			return $price;
	}
}

?>
