package es.uco.iw.model;

public class Report {
	private int id;
	private User user;
	private Piece piece;
	private String description;
	
	public Report(int id, User user, Piece piece, String description){
		setID(id);
		setUser(user);
		setPiece(piece);
		setDescription(description);
	}
	
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
