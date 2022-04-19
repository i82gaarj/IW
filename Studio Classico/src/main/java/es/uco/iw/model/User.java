package es.uco.iw.model;

public class User{

	private int id = -1;
	private String nickname = null;
	private String password = null;
	private int phone = -1;
	private String firstName = null;
	private String lastName = null;
	private String email = null;
	private UserType type = null;
	
	public User(int id, String nickname, String password, int phone, String firstname, String lastname, String email, UserType type){
		setID(id);
		setNickname(nickname);
		setPassword(password);
		setPhone(phone);
		setFirstName(firstname);
		setLastName(lastname);
		setEmail(email);
		setType(type);
	}
	
	public int getID() {
		return id;
	}
	
	public String getNickname() {
		return nickname;
	}
	
	public String getPassword() {
		return password;
	}
	
	public int getPhone() {
		return phone;
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
	
	public void setPhone(int phone) {
		this.phone = phone;
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
