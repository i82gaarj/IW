package es.uco.iw.servlet;

import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.util.ArrayList;

import javax.servlet.ServletContext;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.Part;

import es.uco.iw.controller.InstrumentController;
import es.uco.iw.controller.PieceController;
import es.uco.iw.controller.UserController;
import es.uco.iw.model.Instrument;
import es.uco.iw.model.Piece;
import es.uco.iw.model.User;
import es.uco.iw.helpers.AlphaNumericStringGenerator;

/**
 * Servlet implementation class AddPieceServlet
 */
@WebServlet(name="AddPieceServlet", urlPatterns="/addPieceServlet")
public class AddPieceServlet extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public AddPieceServlet() {
        super();
        // TODO Auto-generated constructor stub
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		response.sendRedirect("addPiece.jsp");
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		ServletContext context = request.getServletContext();
		// TODO Auto-generated method stub
		String title = request.getParameter("title");
		String authorIDStr = request.getParameter("author");
		String yearStr = request.getParameter("year");
		String durationStr = request.getParameter("duration");
		String type = request.getParameter("type");
		String[] instrumentsStr = request.getParameterValues("instrument");
		String scorePath = context.getRealPath(File.separator) + "/scores/" + AlphaNumericStringGenerator.getRandomString(12);
		
		UserController userController = new UserController();
		User author = userController.getUserByID(Integer.parseInt(authorIDStr));
		int year = Integer.parseInt(yearStr);
		int duration = Integer.parseInt(durationStr);
		ArrayList<Instrument> instruments = new ArrayList<Instrument>();
		InstrumentController instrumentController = new InstrumentController();
		for(int i = 0; i < instrumentsStr.length; i++) {
			instruments.add(instrumentController.getInstrumentByID(Integer.parseInt(instrumentsStr[i])));
		}
		
		Part filePart = request.getPart("file"); // Retrieves <input type="file" name="file">
	    InputStream fileContent = filePart.getInputStream();
	    byte[] data = fileContent.readAllBytes();
	    OutputStream out = new FileOutputStream(new File(scorePath));
	    out.write(data);
	    Piece piece = new Piece(-1, title, author, year, duration, type, scorePath, 0, 0, null, instruments);
		PieceController pieceController = new PieceController();
		pieceController.savePiece(piece);
		
	}

}
