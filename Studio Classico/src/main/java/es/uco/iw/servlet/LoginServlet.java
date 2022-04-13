package es.uco.iw.servlet;

import java.io.IOException;

import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import es.uco.iw.controller.UserController;
import es.uco.iw.model.CustomerBean;
import es.uco.iw.model.User;


/**
 * Servlet implementation class Login
 * @author Jaime Garc�a Arjona
 * @author Sof�a Salas Ruiz
 */
@WebServlet(name="LoginServlet", urlPatterns="/loginServlet")
public class LoginServlet extends HttpServlet {
	private static final long serialVersionUID = 1L;

    /**
     * Default constructor. 
     */
    public LoginServlet() {
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		response.sendRedirect("index.jsp");
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		String email = request.getParameter("email");
		String password = request.getParameter("password");
		
		if (email.equals("") || password.equals("")) {
			String errorMsg = "Complete los campos del login";
			request.setAttribute("errorMsg", errorMsg);
			RequestDispatcher rd = request.getRequestDispatcher("/errorPage.jsp");
			rd.forward(request, response);
		}
		else {
			UserController userController = new UserController();
			User user = userController.getUserByEmail(email);
			
			CustomerBean userBean = (CustomerBean) request.getSession().getAttribute("userBean");
			
			if(user != null) {
				if (user.getPassword().equals(password)) {
									
					userBean.setEmail(user.getEmail());
					userBean.setFirstname(user.getFirstName());
					userBean.setLastname(user.getFirstName());
					userBean.setID(user.getID());
					
					response.sendRedirect("/index.jsp");
				}
				else {
					String errorMsg = "El usuario y/o la contrase�a no coinciden con nuestros registros";
					request.setAttribute("errorMsg", errorMsg);
					RequestDispatcher rd = request.getRequestDispatcher("/errorPage.jsp");
					rd.forward(request, response);
				}
			}
			else {
				String errorMsg = "El usuario y/o la contrase�a no coinciden con nuestros registros";
				request.setAttribute("errorMsg", errorMsg);
				RequestDispatcher rd = request.getRequestDispatcher("/errorPage.jsp");
				rd.forward(request, response);
			}
		}
		
	}
}