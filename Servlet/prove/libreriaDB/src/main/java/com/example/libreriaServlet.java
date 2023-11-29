package com.example;

import jakarta.servlet.*;
import jakarta.servlet.http.*;

import java.io.IOException;
import java.io.PrintWriter;
import java.sql.*;


public class libreriaServlet extends HttpServlet{

  private Connection dbConnection = null;

@Override
public void init() {
    try {
        Class.forName("com.mysql.cj.jdbc.Driver");

        String DATABASE_URL = "jdbc:mysql://localhost/php_db";
        String dbUsername = "root";
        String dbPassword = "giovanni";
        dbConnection = DriverManager.getConnection(DATABASE_URL, dbUsername, dbPassword);
        System.out.println("Connected to: " + dbConnection.toString());
    } catch (ClassNotFoundException | SQLException e) {
        e.printStackTrace();
    }
}


  public void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
    response.setContentType("text/html");
    PrintWriter out = response.getWriter();

    out.println("<html><head><title>Libreria</title></head>");
    out.println("<body><h1>Benvenuto nella tua libreria</h1>");

    try{
      Statement statement = dbConnection.createStatement();
      String query = "SELECT * FROM Books";
      ResultSet resultSet = statement.executeQuery(query);

      out.println("<ul>");

      while(resultSet.next()){
        out.println("<li>");
        out.println("Title: " + resultSet.getString("title") + "<br>");
        out.println("Author: " + resultSet.getString("Author")+"<br>");
        out.println("Year: " + resultSet.getString("Year")+"<br>");
        out.println("</li><br>");
      }
      out.println("</ul>");

    }catch(SQLException e){e.printStackTrace();}

    out.println("<br><br>Aggiungi un nuovo libro<br>");

    out.println("<form method=\"post\">");
    out.println("Title: <input name=\"title\" required /><br>");
    out.println("Author: <input name=\"author\" required /><br>");
    out.println("Year: <input name=\"year\" required/>");
    out.println("<input type=\"Submit\" name=\"insert\" value=\"Inserisci\" />");
    out.println("</form>");

    out.println("</body></html>");
  }

  public void doPost(HttpServletRequest request, HttpServletResponse response) throws IOException{
    if(request.getParameter("insert") != null){
      String title = request.getParameter("title");
      String author = request.getParameter("author");
      String year = request.getParameter("year");
  
      try {
        String query = "INSERT INTO Books (title, author, year) VALUES (?,?,?)"; 
        PreparedStatement preparedStatement = dbConnection.prepareStatement(query);
        preparedStatement.setString(1, title);
        preparedStatement.setString(2, author);
        preparedStatement.setString(3, year);
  
        preparedStatement.executeUpdate();
  
        System.out.println("New book added");

        response.sendRedirect(request.getContextPath() + "/books");
      } catch (SQLException e) {
        e.printStackTrace();
      }
    }

  }

  public void destroy(){
    try {
      dbConnection.close();
    } catch (Exception e) {
      e.printStackTrace();
    }
  }



  
}
