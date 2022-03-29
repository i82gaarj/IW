package es.uco.iw.classes;

import java.util.Date;

public class Piece {
	
	private int id;
	private String title;
	private String author;
	private int year;
	private int duration;
	private PieceType type;
	private User uploader;
	private String scorePath; // ruta del archivo de la partitura (se dice score en ingl�s)
	private int nDownloads;
	private int nVisits;
	private Date uploadDate;
	private ArrayList<Instrument> instruments;
	
	public int getID() {
		return id;
	}
	
	public String getTitle() {
		return title;
	}
	
	public String getAuthor() {
		return author;
	}
	
	public int getYear() {
		return year;
	}
	
	public int getDuration() {
		return duration;
	}
	
	public PieceType getPieceType() {
		return type;
	}
	
	public User getUploader() {
		return uploader;
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
	
	public ArrayList<Instrument> getInstruments() {
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
	
	public void setYear(int year) {
		this.year = year;
	}
	
	public void setDuration(int duration) {
		this.duration = duration;
	}
	
	public void setPieceType(PieceType type) {
		this.type = type;
	}
	
	public void setUploader(User uploader) {
		this.uploader = uploader;
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
}
