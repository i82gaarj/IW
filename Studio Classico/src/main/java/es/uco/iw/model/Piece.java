package es.uco.iw.model;

import java.util.ArrayList;
import java.util.Date;

public class Piece {
	
	private int id;
	private String title;
	private int year;
	private int duration;
	private String type;
	private User author;
	private String scorePath; // ruta del archivo de la partitura (se dice score en ingl�s)
	private int nDownloads;
	private int nVisits;
	private Date uploadDate;
	private ArrayList<Instrument> instruments;
	
	public Piece(int id, String title, User author, int year, int duration, String type, String scorePath, int nDownloads, int nVisits, Date uploadDate, ArrayList<Instrument> instruments){
		setID(id);
		setTitle(title);
		setAuthor(author);
		setYear(year);
		setDuration(duration);
		setType(type);
		setScorePath(scorePath);
		setNDownloads(nDownloads);
		setNVisits(nVisits);
		setUploadDate(uploadDate);
		setInstruments(instruments);
	}
	
	public int getID() {
		return id;
	}
	
	public String getTitle() {
		return title;
	}
	
	public User getAuthor() {
		return author;
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
	
	public ArrayList<Instrument> getInstruments() {
		return instruments;
	}
	
	public void setID(int id) {
		this.id = id;
	}
	
	public void setTitle(String title) {
		this.title = title;
	}
	
	public void setAuthor(User author) {
		this.author = author;
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
	
	public void setInstruments(ArrayList<Instrument> instruments){
		this.instruments = instruments;
	}
}
