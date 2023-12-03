package com.example;

import jakarta.servlet.*;
import jakarta.servlet.http.*;

import java.io.IOException;
import java.io.PrintWriter;
import java.sql.*;


public class booksServlet extends HttpServlet{

  private Connection dbConnection = null;
  private static final String DATABASE_URL =   "jdbc:mysql://localhost/php_db";
  public static final String dbUsername = "root";
  public static final String dbPass = "giovanni";
  
  @Override
  public void init(){
    try{
      dbConnection =  DriverManager.getConnection(DATABASE_URL, dbUsername, dbPass);
      System.out.println("Connection established " + dbConnection);
    }catch(SQLException e){e.printStackTrace();}
  }

  public void doGet(HttpServletRequest request, HttpServletResponse response) throws IOException{
    PrintWriter out = response.getWriter();

    out.println("<html><head><title>Books</title></head>");
    out.println("<body>");
    out.println("<h1>Welcome</h1>");
    out.println("<h2>Visualizza la tua lista</h2>");
    out.println("<form method=\"post\">");
    out.println("<input type=\"submit\" value=\"list\" name=\"action\" />");
    out.println("</form>");
    out.println("</body></html>");

  }


  public void doPost(HttpServletRequest request, HttpServletResponse response)throws IOException, ServletException{
    PrintWriter out = response.getWriter();
    String action = request.getParameter("action");
    out.println("<html><head><title>Books</title></head>");
    out.println("<body>");

    switch(action){
      case "insert":{
        try{
        String sql = "INSERT INTO books (isbn, title, author, ranking, year, price) VALUES (?,?,?,?,?,?)";
        PreparedStatement preparedStatement = dbConnection.prepareStatement(sql);
        preparedStatement.setString(1, request.getParameter("isbn"));
        preparedStatement.setString(2, request.getParameter("title"));
        preparedStatement.setString(3, request.getParameter("author"));
        preparedStatement.setString(4, request.getParameter("ranking"));
        preparedStatement.setString(5, request.getParameter("year"));
        preparedStatement.setString(6, request.getParameter("price"));

        preparedStatement.executeUpdate();

        System.out.println("New book added");

        out.println("<script> location.reload(); </script>");
        
        }catch(SQLException e){e.printStackTrace();}
      }break;

      case "update":{

      }break;

      case "delete" : {
        

      }break;
    }

    try{
      String sql = "SELECT * FROM books";
      Statement statement = dbConnection.createStatement();
      ResultSet resultSet = statement.executeQuery(sql);
      out.println("<h1>Lista libri</h1><br>");
      out.println("<ul>");
      while(resultSet.next()){
        out.println("<li>");
        out.println("ISBN: <a href=\"changes?isbn=" + resultSet.getString("isbn") + "\">" + resultSet.getString("isbn") + "</a><br>");
        out.println("Title: " +  resultSet.getString("title") + "\"<br>");
        out.println("Author: " + resultSet.getString("author") + "\"<br>");
        out.println("Ranking: " + resultSet.getString("ranking") + "\" <br>");
        out.println("Year: " + resultSet.getString("year") + "\" <br>");
        out.println("Price: " + resultSet.getString("price") + "\" <br>");
        out.println("</li>");
      }
      out.println("</ul>");

  
      
      
      out.println("<br><br><h2>Aggiungi un nuovo libro</h2>");
      out.println("<form method=\"post\">");
      out.println("ISBN: " + "<input type=\"text\" name=\"isbn\" required type=\"text\" /><br>");
      out.println("Title: " + "<input <input name=\"title\" required type=\"text\"><br>");
      out.println("Author: " + "<input <input name=\"author\" required type=\"text\" /><br>");
      out.println("Ranking: " + "<input <input name=\"ranking\" required type=\"text\"/><br>");
      out.println("Year: " + "<input <input name=\"year\" required type=\"text\"/><br>");
      out.println("Price: " + "<input <input name=\"price\" required type=\"text\"/>");
      out.println("<input type=\"submit\" value=\"insert\" name=\"action\" />");
      out.println("</form>");

    }catch(SQLException e){e.printStackTrace();}


    out.println("</body></html>");

  }
}
