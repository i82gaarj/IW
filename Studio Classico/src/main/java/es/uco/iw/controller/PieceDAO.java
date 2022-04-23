package es.uco.iw.controller;

import java.sql.Connection;
import java.sql.Date;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;

import es.uco.iw.model.Instrument;
import es.uco.iw.model.InstrumentCount;
import es.uco.iw.model.Piece;
import es.uco.iw.model.User;

public class PieceDAO {
	public Piece getPieceByID(int id) {
		DAO dbController = new DAO();
		Piece piece = null;
		try {
			Connection con = dbController.getConnection();
	        PreparedStatement ps = con.prepareStatement("SELECT title, author, year, duration, type, scorepath, ndownloads, nvisits, uploaddate, user FROM PIECES WHERE ID = ?");
	        ps.setInt(1, id);
	        ResultSet rs = ps.executeQuery();
	        String title = null, type = null, scorePath = null, author = null;
	        int userID = -1, year = -1, duration = -1, nDownloads = -1, nVisits = -1;
	        Date uploadDate = null;
	        if(rs.next()) {
	        	title = rs.getString(1);
	        	author = rs.getString(2);
	        	year = rs.getInt(3);
	        	duration = rs.getInt(4);
	        	type = rs.getString(5);
	        	scorePath = rs.getString(6);
	        	nDownloads = rs.getInt(7);
	        	nVisits = rs.getInt(8);
	        	uploadDate = rs.getDate(9);
	        	userID = rs.getInt(10);
	        }
	        con.close();
	        UserDAO userController = new UserDAO();
	        User user = userController.getUserByID(userID);
	        ArrayList<InstrumentCount> instruments = getInstrumentsOfPieceByID(id);
	        piece = new Piece(id, title, author, user, year, duration, type, scorePath, nDownloads, nVisits, uploadDate, instruments);
	    }catch(SQLException e) {
	        System.out.println(e);
	    }
		return piece;
	}
	
	public ArrayList<InstrumentCount> getInstrumentsOfPieceByID(int id) {
		DAO dbController = new DAO();
		Connection con = dbController.getConnection();
		ArrayList<InstrumentCount> instruments = new ArrayList<InstrumentCount>();
        try {
			PreparedStatement ps = con.prepareStatement("SELECT instrument, count FROM pieces_instruments WHERE piece = ?");
			ps.setInt(1, id);
	        ResultSet rs = ps.executeQuery();
	        int instrumentID = -1;
	        int count = -1;
	        while(rs.next()) {
	        	instrumentID = rs.getInt(1);
	        	count = rs.getInt(2);
	        	InstrumentDAO instrumentController = new InstrumentDAO();
	        	Instrument instrument = instrumentController.getInstrumentByID(instrumentID);
	        	InstrumentCount instrumentCount = new InstrumentCount(count, instrument);
	        	instruments.add(instrumentCount);
	        }
	        con.close();
		} catch (SQLException e) {
			System.out.println(e);
		}
		return instruments;
	}
	
	public int savePiece (Piece piece) {
		DAO dbController = new DAO();
		int status = 0;
		try {
			Connection con = dbController.getConnection();
			PreparedStatement ps = con.prepareStatement("INSERT INTO PIECES (title, author, user, year, duration, type, scorepath) VALUES (?, ?, ?, ?, ?, ?)");

			ps.setString(1, piece.getTitle());
			ps.setString(2, piece.getAuthor());
			ps.setInt(3, piece.getUser().getID());
			ps.setInt(4, piece.getYear());
			ps.setInt(5, piece.getDuration());
			ps.setString(6, piece.getType());
			ps.setString(7, piece.getScorePath());
			
			status = ps.executeUpdate();
			saveInstrumentsOfPiece(piece);
			
			con.close();
		} catch (Exception e) {
			e.printStackTrace();
		}
		
		return status;
	}
	
	public int saveInstrumentsOfPiece(Piece piece){
		DAO dbController = new DAO();
		int status = 0;
		try {
			Connection con = dbController.getConnection();
			ArrayList<InstrumentCount> instruments = piece.getInstruments();
			PreparedStatement ps = con.prepareStatement("INSERT INTO PIECES_INSTRUMENTS (piece, instrument) VALUES (?, ?)");
			for (InstrumentCount i: instruments){
				ps.setInt(1, piece.getID());
				ps.setInt(2, i.getInstrument().getID());
				status = ps.executeUpdate();
			}

			
			con.close();
		} catch (Exception e) {
			e.printStackTrace();
		}
		
		return status;
	}
}