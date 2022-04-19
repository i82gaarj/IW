package es.uco.iw.model;
import java.io.Serializable;

/**
 * CustomerBean del usuario
 * @author Jaime Garc�a Arjona
 * @author Sof�a Salas Ruiz
 *
 */
public class PieceBean implements Serializable {

	private static final long serialVersionUID = 1L;
	
	private int id = -1;


	public int getID() {
		return id;
	}
	

	public void setID(int id) {
		this.id = id;
	}

}
