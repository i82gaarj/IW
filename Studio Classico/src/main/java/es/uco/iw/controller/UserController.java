package es.uco.iw.controller;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

import es.uco.iw.model.User;

public class UserController {
	public User getUserByID(int userID) {
		DBController dbController = new DBController();
		try {
			Connection con = dbController.getConnection();
	        PreparedStatement ps = con.prepareStatement("SELECT * FROM users WHERE ID = ?");
	        ps.setInt(1, userID);
	        ResultSet rs = ps.executeQuery();
	        while(rs.next()) {
	        	int id = rs.getInt(1);
	        }
	        con.close();
	    }catch(SQLException e) {
	        System.out.println(e);
	    }
		return null;
	}
}
