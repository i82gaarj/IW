package es.uco.iw.controller;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

import es.uco.iw.model.User;
import es.uco.iw.model.UserType;

public class UserController {
	public User getUserByID(int id) {
		DBController dbController = new DBController();
		User user = null;
		try {
			Connection con = dbController.getConnection();
	        PreparedStatement ps = con.prepareStatement("SELECT nickname, password, firstname, lastname, email, type FROM users WHERE ID = ?");
	        ps.setInt(1, id);
	        ResultSet rs = ps.executeQuery();
	        String nickname = null, password = null, firstname = null, lastname = null, email = null;
	        UserType type = null;
	        if(rs.next()) {
	        	nickname = rs.getString(1);
	        	password = rs.getString(2);
	        	firstname = rs.getString(3);
	        	lastname = rs.getString(4);
	        	email = rs.getString(5);
	        	type = UserType.values()[rs.getInt(6)];
	        }
	        user = new User(id, nickname, password, firstname, lastname, email, type);
	        con.close();
	    }catch(SQLException e) {
	        System.out.println(e);
	    }
		return user;
	}
}
