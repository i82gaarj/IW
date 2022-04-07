package es.uco.iw.controller;

import java.sql.Connection;
import java.sql.Date;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;

import es.uco.iw.model.Author;
import es.uco.iw.model.Instrument;
import es.uco.iw.model.Piece;
import es.uco.iw.model.User;

public class PieceController {
	public Piece getPieceByID(int id) {
		DBController dbController = new DBController();
		Piece piece = null;
		try {
			Connection con = dbController.getConnection();
	        PreparedStatement ps = con.prepareStatement("SELECT title, author, year, duration, type, uploader, scorepath, ndownloads, nvisits, uploaddate FROM users WHERE ID = ?");
	        ps.setInt(1, id);
	        ResultSet rs = ps.executeQuery();
	        String title = null, type = null, scorePath = null;
	        int userID = -1, authorID = -1, year = -1, duration = -1, nDownloads = -1, nVisits = -1;
	        Date uploadDate = null;
	        if(rs.next()) {
	        	title = rs.getString(1);
	        	authorID = rs.getInt(2);
	        	year = rs.getInt(3);
	        	duration = rs.getInt(4);
	        	type = rs.getString(5);
	        	userID = rs.getInt(6);
	        	scorePath = rs.getString(7);
	        	nDownloads = rs.getInt(8);
	        	nVisits = rs.getInt(9);
	        	uploadDate = rs.getDate(10);
	        }
	        con.close();
	        UserController userController = new UserController();
	        User user = userController.getUserByID(userID);
	        AuthorController authorController = new AuthorController();
	        Author author = authorController.getAuthorByID(authorID);
	        ArrayList<Instrument> instruments = getInstrumentsOfPieceByID(id);
	        piece = new Piece(id, title, author, year, duration, type, user, scorePath, nDownloads, nVisits, uploadDate, instruments);
	    }catch(SQLException e) {
	        System.out.println(e);
	    }
		return piece;
	}
	
	public ArrayList<Instrument> getInstrumentsOfPieceByID(int id){
		return null;
	}
}
