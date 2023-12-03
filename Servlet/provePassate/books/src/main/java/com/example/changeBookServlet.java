package com.example;
import java.io.*;
import java.sql.*;
import jakarta.servlet.*;
import jakarta.servlet.http.*;


public class changeBookServlet extends HttpServlet{
    private Connection dbConnection = null;
    private static final String DB_URL = "jdbc:mysql://localhost/php_db";
    private static final String USERNAME = "root";
    private static final String PASSWORD = "giovanni";

    @Override
    public void init(){
        try {
            dbConnection = DriverManager.getConnection(DB_URL, USERNAME, PASSWORD);
            System.out.println("Connection to: " + dbConnection);
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    public void doGet(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException{
        PrintWriter out = response.getWriter();

        out.println("<html><head><title>Modifica o elimina il tuo libro!</title></head><body>");

        String isbn = request.getParameter("isbn");

        try {
            String sql = "SELECT * FROM books WHERE isbn = ?";
            PreparedStatement preparedStatement = dbConnection.prepareStatement(sql);
            preparedStatement.setString(1, isbn);
            ResultSet resultSet = preparedStatement.executeQuery();
            
            if (resultSet.next()) {
                out.println("<h1>Modifica il tuo libro</h1><br>");
                // Ci sono risultati, quindi puoi visualizzare il form
                out.println("<form method=\"post\">");
                out.println("ISBN: " + "<input type=\"text\" name=\"isbn\" readonly type=\"text\" value=\"" + resultSet.getString("isbn") + "\" /><br>");
                out.println("Title: " + "<input name=\"title\" required type=\"text\" value=\"" + resultSet.getString("title") + "\"/><br>");
                out.println("Author: " + "<input name=\"author\" required type=\"text\" value=\"" + resultSet.getString("author") + "\"/><br>");
                out.println("Ranking: " + "<input name=\"ranking\" required type=\"text\" value=\"" + resultSet.getString("ranking") + "\" /><br>");
                out.println("Year: " + "<input name=\"year\" required type=\"text\" value=\"" + resultSet.getString("year") + "\" /><br>");
                out.println("Price: " + "<input name=\"price\" required type=\"text\" value=\"" + resultSet.getString("price") + "\" />");
                out.println("<input value=\"update\" type=\"submit\" name=\"action\" /> ");
                out.println("<input value=\"delete\" type=\"submit\" name=\"action\" /> ");

                out.println("</form>");
            } else {
                out.println("<h1>Libro non trovato</h1>");
            }



        } catch (SQLException e) {
            e.printStackTrace();
        }

        out.println("<h2>Torna alla <a href=\"" + request.getContextPath() + "/books"  + "\">pagina iniziale</a></h2>");

        out.println("</body></html>");
    }

    public void doPost(HttpServletRequest request, HttpServletResponse response)throws IOException, ServletException{
        PrintWriter out = response.getWriter();
        String action = request.getParameter("action");
        out.println("<html><body>");
    
        switch(action){
            case "update":{
                try {
                    String sql = "UPDATE books SET title = ? , author  = ? , ranking = ? ,year = ? , price  = ?  WHERE isbn = ?";
                    PreparedStatement preparedStatement = dbConnection.prepareStatement(sql);
                    preparedStatement.setString(1, request.getParameter("title"));
                    preparedStatement.setString(2, request.getParameter("author"));
                    preparedStatement.setString(3, request.getParameter("ranking"));
                    preparedStatement.setString(4, request.getParameter("year"));
                    preparedStatement.setString(5, request.getParameter("price"));
                    preparedStatement.setString(6, request.getParameter("isbn"));

                    preparedStatement.executeUpdate();

                    System.out.println("Update successfully");

                    response.sendRedirect(request.getContextPath() + "/changes?isbn=" + request.getParameter("isbn"));

                } catch (SQLException e) {
                    e.printStackTrace();
                }
                
            }break;
        
            case "delete" : {
                try {
                    String sql = "DELETE FROM books WHERE isbn = ?";
                    PreparedStatement preparedStatement = dbConnection.prepareStatement(sql);
                    preparedStatement.setString(1, request.getParameter("isbn"));

                    preparedStatement.executeUpdate();

                    System.out.println("Delete successfully");

                    out.println("<h2>Torna alla <a href=\"" + request.getContextPath() + "/books"  + "\">pagina iniziale</a></h2>");

                } catch (SQLException e) {
                    e.printStackTrace();
                }
        
            }break;
        }  

        out.println("</body></html>");

    }
}
