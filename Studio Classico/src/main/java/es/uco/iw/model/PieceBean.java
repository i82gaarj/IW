package es.uco.iw.model;
import java.io.Serializable;
import java.util.ArrayList;
import java.util.Date;

/**
 * CustomerBean del usuario
 * @author Jaime García Arjona
 * @author Sofía Salas Ruiz
 *
 */
public class PieceBean implements Serializable {

	private static final long serialVersionUID = 1L;
	
	private int id = -1;
	private String title = null;
	private int year = -1;
	private int duration = -1;
	private String type = null;
	private String author = null;
	private User user = null;
	private String scorePath = null; // ruta del archivo de la partitura (se dice score en inglï¿½s)
	private int nDownloads = -1;
	private int nVisits = -1;
	private Date uploadDate = null;
	private ArrayList<InstrumentCount> instruments = null;

	
	public PieceBean(){
		
	}
	
	public int getID() {
		return id;
	}
	
	public String getTitle() {
		return title;
	}
	
	public String getAuthor() {
		return author;
	}
	
	public User getUser() {
		return user;
	}
	
	public int getYear() {
		return year;
	}
	
	public int getDuration() {
		return duration;
	}
	
	public String getType() {
		return type;
	}
	
	public String getScorePath() {
		return scorePath;
	}
	
	public int getNVisits() {
		return nVisits;
	}
	
	public int getNDownloads() {
		return nDownloads;
	}
	
	public Date getUploadDate() {
		return uploadDate;
	}
	
	public ArrayList<InstrumentCount> getInstruments() {
		return instruments;
	}
	
	public void setID(int id) {
		this.id = id;
	}
	
	public void setTitle(String title) {
		this.title = title;
	}
	
	public void setAuthor(String author) {
		this.author = author;
	}
	
	public void setUser(User user) {
		this.user = user;
	}
	
	public void setYear(int year) {
		this.year = year;
	}
	
	public void setDuration(int duration) {
		this.duration = duration;
	}
	
	public void setType(String type) {
		this.type = type;
	}
	
	public void setScorePath(String scorePath) {
		this.scorePath = scorePath;
	}
	
	public void setNVisits(int nVisits) {
		this.nVisits = nVisits;
	}
	
	public void setNDownloads(int nDownloads) {
		this.nDownloads = nDownloads;
	}
	
	public void setUploadDate(Date uploadDate) {
		this.uploadDate = uploadDate;
	}

	public void setInstruments(ArrayList<InstrumentCount> instruments){
		this.instruments = instruments;
	}
	
	public void addInstrument(InstrumentCount ic) {
		if (this.instruments == null) {
			instruments = new ArrayList<InstrumentCount>();
		}
		this.instruments.add(ic);
	}
}
