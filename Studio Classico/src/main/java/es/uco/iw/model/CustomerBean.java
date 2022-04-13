package es.uco.iw.model;
import java.io.Serializable;

/**
 * CustomerBean del usuario
 * @author Jaime García Arjona
 * @author Sofía Salas Ruiz
 *
 */
public class CustomerBean implements Serializable {

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
	

	public String getFirstname() {
		return firstname;
	}

	public void setFirstname(String firstname) {
		this.firstname = firstname;
	}

	public String getLastname() {
		return lastname;
	}

	public void setLastname(String lastname) {
		this.lastname = lastname;
	}
}
