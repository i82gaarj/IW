package es.uco.iw.model;
import java.io.Serializable;

/**
 * CustomerBean del usuario
 * @author Jaime García Arjona
 * @author Sofía Salas Ruiz
 *
 */
public class UserBean implements Serializable {

	private static final long serialVersionUID = 1L;
	
	private int id = -1;
	private String email = null;
	private String firstname = null;
	private String lastname = null;

	public int getID() {
		return id;
	}
	

	public void setID(int id) {
		this.id = id;
	}
	
	public String getEmail() {
		return email;
	}
	

	public void setEmail(String email) {
		this.email = email;
	}
	

	public String getFirstName() {
		return firstname;
	}

	public void setFirstName(String firstname) {
		this.firstname = firstname;
	}

	public String getLastName() {
		return lastname;
	}

	public void setLastName(String lastname) {
		this.lastname = lastname;
	}
}
