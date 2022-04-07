package es.uco.iw.controller;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

import es.uco.iw.model.Author;

public class AuthorController {
	public Author getAuthorByID(int id) {
		DBController dbController = new DBController();
		Author author = null;
		try {
			Connection con = dbController.getConnection();
	        PreparedStatement ps = con.prepareStatement("SELECT name, description FROM authors WHERE ID = ?");
	        ps.setInt(1, id);
	        ResultSet rs = ps.executeQuery();
	        String name = null, description = null;
	        if(rs.next()) {
	        	name = rs.getString(1);
	        	description = rs.getString(2);
	        }
	        author = new Author(id, name, description);
	        con.close();
	    }catch(SQLException e) {
	        System.out.println(e);
	    }
		return author;
	}
}
