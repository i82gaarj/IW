package es.uco.iw.controller;

import java.sql.Connection;
import java.sql.Date;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

import es.uco.iw.model.Piece;
import es.uco.iw.model.User;
import es.uco.iw.model.UserType;

public class PieceController {
	public Piece getPieceByID(int id) {
		DBController dbController = new DBController();
		Piece piece = null;
		try {
			Connection con = dbController.getConnection();
	        PreparedStatement ps = con.prepareStatement("SELECT title, author, year, duration, type, uploader, scorepath, ndownloads, nvisits, uploaddate FROM users WHERE ID = ?");
	        ps.setInt(1, id);
	        ResultSet rs = ps.executeQuery();
	        String title = null, author = null, scorepath = null;
	        int uploaderID = -1, year = -1, duration = -1, pieceTypeValue = -1, nDownloads = -1, nVisits = -1;
	        Date uploadDate = null;
	        if(rs.next()) {
	        	title = rs.getString(1);
	        	author = rs.getString(2);
	        	year = rs.getInt(3);
	        	duration = rs.getInt(4);
	        	pieceTypeValue = rs.getInt(5);
	        	uploaderID = rs.getInt(6);
	        	scorepath = rs.getString(7);
	        	nDownloads = rs.getInt(8);
	        	nVisits = rs.getInt(9);
	        	uploadDate = rs.getDate(10);
	        }
	        con.close();
	    }catch(SQLException e) {
	        System.out.println(e);
	    }
		return piece;
	}
}
