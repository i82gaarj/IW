package es.uco.iw.controller;

import java.io.FileNotFoundException;
import java.io.InputStream;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.util.Properties;

import javax.servlet.ServletContext;

public class DBController {
	protected static Connection con = null;
	protected static ServletContext context = null;
	
	public DBController(ServletContext context) {
		DBController.context = context;
	}
	
	public static Properties getProps() {
		Properties prop = new Properties();
		
		InputStream inputStream;
		try {
			inputStream = context.getResourceAsStream(context.getInitParameter("propertiesPath"));
			prop.load(inputStream);
		}
		catch(FileNotFoundException e1){
			e1.printStackTrace();
		}
		catch (Exception e2){
			e2.printStackTrace();
		}
		return prop;
    }
	
	protected static Connection getConnection() {
		try {
			con = DriverManager.getConnection(context.getInitParameter("jdbc"), context.getInitParameter("db-user"), context.getInitParameter("db-pass"));
		} catch(SQLException e) {
			System.out.println(e);
		}
		return con;
	}
	
	public static void close() {
		try {
			con.close();
		} catch (SQLException e) {
			e.printStackTrace();
		}
	}
}
