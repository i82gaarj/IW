package es.uco.iw.controller;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

import es.uco.iw.model.Instrument;

public class InstrumentController {
	public Instrument getInstrumentByID(int id) {
		DBController dbController = new DBController();
		Instrument instrument = null;
		try {
			Connection con = dbController.getConnection();
	        PreparedStatement ps = con.prepareStatement("SELECT name FROM instruments WHERE ID = ?");
	        ps.setInt(1, id);
	        ResultSet rs = ps.executeQuery();
	        String name = null;
	        if(rs.next()) {
	        	name = rs.getString(1);
	        }
	        instrument = new Instrument(id, name);
	        con.close();
	    }catch(SQLException e) {
	        System.out.println(e);
	    }
		return instrument;
	}
}
