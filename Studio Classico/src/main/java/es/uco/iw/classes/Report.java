package es.uco.iw.classes;

public class Report {
	private int id;
	private User user;
	private Piece piece;
	private String description;
	
	public int getID() {
		return id;
	}
	
	public User getUser() {
		return user;
	}
	
	public Piece getPiece() {
		return piece;
	}
	
	public String getDescription() {
		return description;
	}
	
	public void setID(int id) {
		this.id = id;
	}
	
	public void setUser(User user) {
		this.user = user;
	}
	
	public void setPiece(Piece piece) {
		this.piece = piece;
	}
	
	public void setDescription(String description) {
		this.description = description;
	}
}
