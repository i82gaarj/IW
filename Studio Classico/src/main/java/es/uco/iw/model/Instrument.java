package es.uco.iw.model;

public class Instrument {
	private int id;
	private String name;
	
	public Instrument(int id, String name){
		setID(id);
		setName(name);
	}
	
	public int getID() {
		return id;
	}
	
	public String getName() {
		return name;
	}
	
	public void setID(int id) {
		this.id = id;
	}
	
	public void setName(String name) {
		this.name = name;
	}
}
