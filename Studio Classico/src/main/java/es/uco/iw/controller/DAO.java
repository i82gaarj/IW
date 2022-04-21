package es.uco.iw.controller;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;


public class DAO {
	protected Connection con = null;
	protected String sDriver = "com.mysql.cj.jdbc.Driver";
	protected String sURL = "jdbc:mysql://192.168.5.5:3306/studio_classico";
	
	public DAO() {
	}
	
	protected Connection getConnection() {
		try {
			Class.forName(sDriver).getDeclaredConstructor().newInstance();
			con = DriverManager.getConnection(sURL, "db", "jhJFwBQ40j2VTAEy");
		} catch(SQLException e) {
			System.out.println(e);
		} catch (Exception e) {
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
