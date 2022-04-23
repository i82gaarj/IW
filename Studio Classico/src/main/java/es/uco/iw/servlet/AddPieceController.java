package es.uco.iw.servlet;

import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.util.ArrayList;

import javax.servlet.RequestDispatcher;
import javax.servlet.ServletContext;
import javax.servlet.ServletException;
import javax.servlet.annotation.MultipartConfig;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;
import javax.servlet.http.Part;

import es.uco.iw.controller.InstrumentDAO;
import es.uco.iw.controller.PieceDAO;
import es.uco.iw.controller.UserDAO;
import es.uco.iw.model.Instrument;
import es.uco.iw.model.InstrumentCount;
import es.uco.iw.model.Piece;
import es.uco.iw.model.PieceBean;
import es.uco.iw.model.User;
import es.uco.iw.helpers.AlphaNumericStringGenerator;

/**
 * Servlet implementation class AddPieceServlet
 */
@WebServlet(name="AddPieceController", urlPatterns="/addPiece")
@MultipartConfig(
		  fileSizeThreshold = 1024 * 1024 * 1, // 1 MB
		  maxFileSize = 1024 * 1024 * 50,      // 50 MB
		  maxRequestSize = 1024 * 1024 * 100   // 100 MB
		)
public class AddPieceController extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public AddPieceController() {
        super();
        // TODO Auto-generated constructor stub
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		InstrumentDAO instrumentDAO = new InstrumentDAO();
		ArrayList<Instrument> allInstruments = instrumentDAO.getAllInstruments();
		request.setAttribute("instruments", allInstruments);
		RequestDispatcher rd = request.getRequestDispatcher("/addPiece.jsp");
		rd.forward(request, response);
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		ServletContext context = request.getServletContext();
		
		String action = request.getParameter("action");

		if (action == null) {
			request.setAttribute("errorMsg", "Acceso inválido");
			RequestDispatcher rd = request.getRequestDispatcher("/errorPage.jsp");
			rd.forward(request, response);
		}
		else if (action.equalsIgnoreCase("new")) {
			String title = request.getParameter("title");
			String userIDStr = request.getParameter("user");
			String author = request.getParameter("author");
			String yearStr = request.getParameter("year");
			String durationStr = request.getParameter("duration");
			String type = request.getParameter("type");


			UserDAO userController = new UserDAO();
			User user = userController.getUserByID(Integer.parseInt(userIDStr));
			int year = Integer.parseInt(yearStr);
			int duration = Integer.parseInt(durationStr);
			PieceBean pieceBean = new PieceBean();
			request.setAttribute("pieceBean", pieceBean);
			pieceBean.setTitle(title);
			pieceBean.setUser(user);
			pieceBean.setAuthor(author);
			pieceBean.setDuration(duration);
			pieceBean.setYear(year);
			pieceBean.setType(type);
			
			InstrumentDAO instrumentDAO = new InstrumentDAO();
			ArrayList<Instrument> allInstruments = instrumentDAO.getAllInstruments();
			request.setAttribute("instruments", allInstruments);
			
			RequestDispatcher rd = request.getRequestDispatcher("/addInstrumentsToNewPiece.jsp");
			rd.forward(request, response);
		}
		else if (action.equalsIgnoreCase("addInst")) {
			HttpSession session = request.getSession();
			PieceBean pieceBean = (PieceBean) session.getAttribute("pieceBean");
			
			String instrumentStr = request.getParameter("instrument");
			String countStr = request.getParameter("count");
			
			int instrumentID = Integer.parseInt(instrumentStr);
			int count = Integer.parseInt(countStr);
			
			InstrumentDAO instrumentDAO = new InstrumentDAO();
			Instrument instrument = instrumentDAO.getInstrumentByID(instrumentID);
			
			InstrumentCount ic = new InstrumentCount(count, instrument);
			pieceBean.addInstrument(ic);
			
			ArrayList<Instrument> allInstruments = instrumentDAO.getAllInstruments();
			request.setAttribute("instruments", allInstruments);
			
			RequestDispatcher rd = request.getRequestDispatcher("/addInstrumentsToNewPiece.jsp");
			rd.forward(request, response);
		}
		else if (action.equalsIgnoreCase("uploadScore")) {
			String scorePath = context.getRealPath(File.separator) + "/scores/" + AlphaNumericStringGenerator.getRandomString(12);
		}
		else if (action.equalsIgnoreCase("save")) {
			
		}
		else {
			request.setAttribute("errorMsg", "Acceso inválido");
			RequestDispatcher rd = request.getRequestDispatcher("/errorPage.jsp");
			rd.forward(request, response);
		}

		
		
	    /*Piece piece = new Piece(-1, title, author, user, year, duration, type, scorePath, 0, 0, null, instruments);
		PieceDAO pieceController = new PieceDAO();
		pieceController.savePiece(piece);*/
		
	}

}
