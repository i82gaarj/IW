package es.uco.iw.controller;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;

import es.uco.iw.model.Instrument;

public class InstrumentDAO {
	public Instrument getInstrumentByID(int id) {
		DAO dbController = new DAO();
		Instrument instrument = null;
		try {
			Connection con = dbController.getConnection();
	        PreparedStatement ps = con.prepareStatement("SELECT name FROM INSTRUMENTS WHERE ID = ?");
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
	
	public ArrayList<Instrument> getAllInstruments(){
		DAO dbController = new DAO();
		ArrayList<Instrument> instruments = new ArrayList<Instrument>();
		try {
			Connection con = dbController.getConnection();
	        PreparedStatement ps = con.prepareStatement("SELECT id, name FROM INSTRUMENTS WHERE 1");
	        ResultSet rs = ps.executeQuery();
	        String name = null;
	        int id = -1;
	        while(rs.next()) {
	        	id = rs.getInt(1);
	        	name = rs.getString(2);
		        Instrument instrument = new Instrument(id, name);
		        instruments.add(instrument);
	        }
	        con.close();
	    }catch(SQLException e) {
	        System.out.println(e);
	    }
		return instruments;
	}
}
