package es.uco.iw.controller;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class DBController {
	protected Connection con = null;
	
	public DBController() {
	}
	
	protected Connection getConnection() {
		try {
			con = DriverManager.getConnection("IP", "USER", "PASS");
		} catch(SQLException e) {
			System.out.println(e);
		}
		return con;
	}
	
	public void close() {
		try {
			con.close();
		} catch (SQLException e) {
			e.printStackTrace();
		}
	}
}
