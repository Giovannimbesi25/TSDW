package com.example;

import jakarta.servlet.*;
import jakarta.servlet.http.*;

import java.io.IOException;
import java.io.PrintWriter;
import java.sql.*;


public class booksServlet extends HttpServlet{

  private Connection dbConnection = null;

  @Override
  public void init(){
    try{
      String database_url =   "jdbc:mysql://localhost/php_db";
      String dbUsername = "root";
      String dbPass = "giovanni";
      dbConnection =  DriverManager.getConnection(database_url, dbUsername, dbPass);
      System.out.println("Connection established " + dbConnection);
    }catch(SQLException e){e.printStackTrace();}
  }

  public void doGet(HttpServletRequest request, HttpServletResponse response) throws IOException{
    PrintWriter out = response.getWriter();

    out.println("<html><body><head><title>Books</title></head>");

    out.println("<body><center>");
    out.println("<h1>Welcome</h1>");
    out.println("<h2>Visualizza la tua lista</h2>");
    out.println("<input type=\"submit\" value=\"list\" name=\"action\" />");
    out.println("</center></body></html>");

  }


  public void doPost(HttpServletRequest request, HttpServletResponse response)throws IOException, ServletException{
    PrintWriter out = response.getWriter();
    String action = request.getParameter("action");

    switch(action){
      case "list" : {
        try{
          String query = "SELECT * FROM books";
          Statement statement = dbConnection.createStatement();
          ResultSet resultSet = statement.executeQuery(query);

          while(resultSet.next()){
            out.println("<form method=\"post\"/>");
            out.println("ISBN: " + "<input type=\"text\" name=\"isbn\" readonly type=\"text\" value=\"" + resultSet.getString("isbn") + "\" (>)");
            out.println("Title: " + "<input <input name=\"title\" readonly type=\"text\" value=\"" + resultSet.getString("title") + "\" (>)");
            out.println("Author: " + "<input <input name=\"author\" readonly type=\"text\" value=\"" + resultSet.getString("author") + "\" (>)");
            out.println("Ranking: " + "<input <input name=\"ranking\" readonly type=\"text\" value=\"" + resultSet.getString("ranking") + "\" (>)");
            out.println("Year: " + "<input <input name=\"year\" readonly type=\"text\" value=\"" + resultSet.getString("year") + "\" (>)");
            out.println("Price: " + "<input <input name=\"price\" readonly type=\"text\" value=\"" + resultSet.getString("price") + "\" (>)");
          }
        }catch(SQLException e){e.printStackTrace();}



      }break;

      case "update":{

      }break;

      case "delete" : {

      }break;
    }
  }
}
