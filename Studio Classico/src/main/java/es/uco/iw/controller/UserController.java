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
			PreparedStatement ps = con.prepareStatement("SELECT nickname, password, phone, firstname, lastname, email, type FROM USERS WHERE ID = ?");
		    ps.setInt(1, id);
		    ResultSet rs = ps.executeQuery();
		    String nickname = null, password = null, firstname = null, lastname = null, email = null;
		    UserType type = null;
		    int phone = -1;
			if(rs.next()) {
				nickname = rs.getString(1);
				password = rs.getString(2);
				phone = rs.getInt(3);
				firstname = rs.getString(4);
				lastname = rs.getString(5);
				email = rs.getString(6);
				type = UserType.values()[rs.getInt(7)];
			}
		    user = new User(id, nickname, password, phone, firstname, lastname, email, type);
		    con.close();
		}catch(SQLException e) {
		    System.out.println(e);
		}
		return user;
	}
	
	public User getUserByEmail(String email) {
		DBController dbController = new DBController();
		User user = null;
		try {
			Connection con = dbController.getConnection();
			PreparedStatement ps = con.prepareStatement("SELECT id FROM USERS WHERE EMAIL = ?");
			ps.setString(1, email);
			ResultSet rs = ps.executeQuery();
			int id = -1;
			if(rs.next()) {
				id = rs.getInt(1);
				user = getUserByID(id);
			}
			con.close();
		}catch(SQLException e) {
		    System.out.println(e);
		}
		return user;
	}
	
	public int saveUser (User user) {
		DBController dbController = new DBController();
		int status = 0;
		try {
			Connection con = dbController.getConnection();
			PreparedStatement ps = con.prepareStatement("INSERT INTO USERS (email, password, nickname, firstname, lastname, phone, type) VALUES (?, ?, ?, ?, ?, ?, ?)");

			ps.setString(1, user.getEmail());
			ps.setString(2, user.getPassword());
			ps.setString(3, user.getNickname());
			ps.setString(4, user.getFirstName());
			ps.setString(5, user.getLastName());
			ps.setInt(6, user.getPhone());
			ps.setInt(7, user.getType().ordinal());
			
			status = ps.executeUpdate();
			
			con.close();
		} catch (Exception e) {
			e.printStackTrace();
		}
		
		return status;
	}
}
