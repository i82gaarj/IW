package es.uco.iw.model;

public class Author {
	private int id;
	private String name;
	private String description;
	
	public Author(int id, String name, String description){
		setID(id);
		setName(name);
		setDescription(description);
	}
	
	public int getID(){
		return id;
	}
	
	public String getName(){
		return name;
	}
	
	public String getDescription(){
		return description;
	}
	
	public void setID(int id){
		this.id = id;
	}
	
	public void setName(String name){
		this.name = name;
	}
	
	public void setDescription(String description){
		this.description = description;
	}
}
