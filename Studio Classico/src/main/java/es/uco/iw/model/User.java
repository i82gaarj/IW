package es.uco.iw.model;

public class User {

	private int id;
	private String nickname;
	private String password;
	private String firstName;
	private String lastName;
	private String email;
	private UserType type;
	
	public int getID() {
		return id;
	}
	
	public String getNickname() {
		return nickname;
	}
	
	public String getPassword() {
		return password;
	}
	
	public String getFirstName() {
		return firstName;
	}
	
	public String getLastName() {
		return lastName;
	}
	
	public String getEmail() {
		return email;
	}
	
	public UserType getType() {
		return type;
	}
	
	public void setID(int id) {
		this.id = id;
	}
	
	public void setNickname(String nickname) {
		this.nickname = nickname;
	}
	
	public void setPassword(String password) {
		this.password = password;
	}
	
	public void setFirstName(String firstName) {
		this.firstName = firstName;
	}
	
	public void setLastName(String lastName) {
		this.lastName = lastName;
	}
	
	public void setEmail(String email) {
		this.email = email;
	}
	
	public void setType(UserType type) {
		this.type = type;
	}
}
