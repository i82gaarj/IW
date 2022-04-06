package es.uco.iw.controller;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

import es.uco.iw.model.Piece;
import es.uco.iw.model.Report;
import es.uco.iw.model.User;
import es.uco.iw.model.UserType;

public class ReportController {
	public Report getReportByID(int id) {
		DBController dbController = new DBController();
		Report report = null;
		try {
			Connection con = dbController.getConnection();
	        PreparedStatement ps = con.prepareStatement("SELECT user, piece, description FROM reports WHERE ID = ?");
	        ps.setInt(1, id);
	        ResultSet rs = ps.executeQuery();
	        int userID = -1;
	        int pieceID = -1;
	        String description = null;
	        if(rs.next()) {
	        	userID = rs.getInt(1);
	        	pieceID = rs.getInt(2);
	        	description = rs.getString(3);
	        }
	        UserController userController = new UserController();
	        PieceController pieceController = new PieceController();
	        User user = userController.getUserByID(userID);
	        Piece piece = pieceController.getPieceByID(pieceID);
	        con.close();
	    }catch(SQLException e) {
	        System.out.println(e);
	    }
		return report;
	}
}
