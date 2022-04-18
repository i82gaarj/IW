package es.uco.iw.controller;

import java.sql.Connection;
import java.sql.Date;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;

import es.uco.iw.model.Instrument;
import es.uco.iw.model.Piece;
import es.uco.iw.model.User;

public class PieceController {
	public Piece getPieceByID(int id) {
		DBController dbController = new DBController();
		Piece piece = null;
		try {
			Connection con = dbController.getConnection();
	        PreparedStatement ps = con.prepareStatement("SELECT title, author, year, duration, type, scorepath, ndownloads, nvisits, uploaddate FROM users WHERE ID = ?");
	        ps.setInt(1, id);
	        ResultSet rs = ps.executeQuery();
	        String title = null, type = null, scorePath = null;
	        int authorID = -1, year = -1, duration = -1, nDownloads = -1, nVisits = -1;
	        Date uploadDate = null;
	        if(rs.next()) {
	        	title = rs.getString(1);
	        	authorID = rs.getInt(2);
	        	year = rs.getInt(3);
	        	duration = rs.getInt(4);
	        	type = rs.getString(5);
	        	scorePath = rs.getString(6);
	        	nDownloads = rs.getInt(7);
	        	nVisits = rs.getInt(8);
	        	uploadDate = rs.getDate(9);
	        }
	        con.close();
	        UserController userController = new UserController();
	        User author = userController.getUserByID(authorID);
	        ArrayList<Instrument> instruments = getInstrumentsOfPieceByID(id);
	        piece = new Piece(id, title, author, year, duration, type, scorePath, nDownloads, nVisits, uploadDate, instruments);
	    }catch(SQLException e) {
	        System.out.println(e);
	    }
		return piece;
	}
	
	public ArrayList<Instrument> getInstrumentsOfPieceByID(int id) {
		DBController dbController = new DBController();
		Connection con = dbController.getConnection();
		ArrayList<Instrument> instruments = new ArrayList<Instrument>();
        try {
			PreparedStatement ps = con.prepareStatement("SELECT instrument FROM pieces_instruments WHERE piece = ?");
			ps.setInt(1, id);
	        ResultSet rs = ps.executeQuery();
	        int instrumentID = -1;
	        while(rs.next()) {
	        	instrumentID = rs.getInt(1);
	        	InstrumentController instrumentController = new InstrumentController();
	        	Instrument instrument = instrumentController.getInstrumentByID(instrumentID);
	        	instruments.add(instrument);
	        }
	        con.close();
		} catch (SQLException e) {
			System.out.println(e);
		}
		return instruments;
	}
	
	public int savePiece (Piece piece) {
		DBController dbController = new DBController();
		int status = 0;
		try {
			Connection con = dbController.getConnection();
			PreparedStatement ps = con.prepareStatement("INSERT INTO PIECES (title, author, year, duration, type, scorepath) VALUES (?, ?, ?, ?, ?, ?)");

			ps.setString(1, piece.getTitle());
			ps.setInt(2, piece.getAuthor().getID());
			ps.setInt(3, piece.getYear());
			ps.setInt(4, piece.getDuration());
			ps.setString(5, piece.getType());
			ps.setString(6, piece.getScorePath());
			
			status = ps.executeUpdate();
			
			con.close();
		} catch (Exception e) {
			e.printStackTrace();
		}
		
		return status;
	}
}
