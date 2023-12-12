package com.example;

import jakarta.servlet.http.*;
import jakarta.servlet.*;
import java.io.PrintWriter;
import java.io.IOException;

import java.sql.*;

public class studentiServlet extends HttpServlet{  
  Connection dbConnection = null;

  @Override
  public void init(){
    try{
      dbConnection = DriverManager.getConnection("jdbc:mysql://localhost/php_db", "root", "giovanni");
      System.out.println("Connection established " + dbConnection);
    }catch(SQLException e){e.printStackTrace();}
  }

  protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
    PrintWriter out = response.getWriter();
    out.println("<html><head><title>Studenti</title></head><body>");

    if(request.getParameter("matricola")!=null){
      String matricola = request.getParameter("matricola");
      out.println("<h1>Scheda Studente Matricola " + matricola+ " </h1>");

      try{
        String sql = "SELECT * FROM studenti WHERE matricola=?";
        PreparedStatement preparedStatement = dbConnection.prepareStatement(sql);
        preparedStatement.setString(1, matricola);
        ResultSet resultSet = preparedStatement.executeQuery();
        if(resultSet.next()){
          out.println("<h3>Nome: " + resultSet.getString("nome") + "</h3>");
          out.println("<h3>Cognome: " + resultSet.getString("cognome") + "</h3>");
          out.println("<h3>Facoltà: " + resultSet.getString("facolta")+ "</h3><br>");

          try {
          String sqlEsami = "SELECT * FROM esami WHERE studente=?";
          PreparedStatement preparedStatementEsami = dbConnection.prepareStatement(sqlEsami);
          preparedStatementEsami.setString(1, matricola);
          ResultSet resultSetEsami = preparedStatementEsami.executeQuery();

          if(resultSetEsami.next()){
            out.println("<h2>Lista esami</h2><br>");
            do{
              out.println("<form method='post'>");
              out.println("<input hidden type='text'name='codice' value='"+ resultSetEsami.getString("codice") +"'+ />");
              out.println("<input hidden type='text'name='matricola' value='"+ matricola +"'+ />");
              out.println("<h4>Nome: <input name='nome' type='text' required value='"+ resultSetEsami.getString("nome")+"'+ /> </h4>");
              out.println("<h4>Votazione: <input name='voto' type='text' required value='"+ resultSetEsami.getString("voto")+"'+ /> </h4>");
              out.println("<input type='submit' name='action' value='updateEsame'+ />");
              out.println("<input type='submit' name='action' value='deleteEsame'+ />");
              out.println("</form>");
            }while(resultSetEsami.next());  
          }
          preparedStatementEsami.close();
        } catch (SQLException e) {e.printStackTrace();}
        }
        preparedStatement.close();

      }catch(SQLException e){e.printStackTrace();}

    }else{
      //Creazione tabelle 
      // try{
      //   String sqlStudenti = "CREATE TABLE studenti (matricola INT AUTO_INCREMENT PRIMARY KEY, nome VARCHAR(30) NOT NULL, cognome VARCHAR(30) NOT NULL, facolta VARCHAR(30) NOT NULL)";
      //   Statement statementStudenti = dbConnection.createStatement();
      //   statementStudenti.execute(sqlStudenti);

      //   String sqlEsami = "CREATE TABLE esami (codice INT AUTO_INCREMENT PRIMARY KEY, nome VARCHAR(30) NOT NULL, voto INT NOT NULL, studente INT NOT NULL)";
      //   Statement statementEsami = dbConnection.createStatement();
      //   statementEsami.execute(sqlEsami);
      //   statementEsami.close();
      //   statementStudenti.close();
      // }catch(SQLException e){e.printStackTrace();}

      out.println("<h1>Registro studenti</h1>");
        
      try {
        String sql = "SELECT * from studenti";
        Statement statement = dbConnection.createStatement();
        ResultSet resultSet = statement.executeQuery(sql);
        out.println("<ul>");
        if (resultSet.next()){
          do{
          out.println("<li>");
          out.println("<a href='/studenti?matricola=" + resultSet.getString("matricola") + "'><h3>Nome: " + resultSet.getString("nome") + "</h3></a>");
          out.println("<h4>Cognome: " + resultSet.getString("cognome") + "</h4>");
          out.println("<h4>Facoltà: " + resultSet.getString("facolta")+ "</h4>");
          out.println("</li>");
          } while(resultSet.next());
        } else{
          out.println("<br><h2>Nessuno studente registrato</h2>");
        }
        out.println("</ul><br><br>");
      } catch (SQLException e) {e.printStackTrace();}

      out.println("<h3>Aggiungi un nuovo studente</h3>");
      out.println("<form method='post' >");
      out.println("<h3>Nome: <input name='nome' type='text' required/></h3>");
      out.println("<h3>Cognome: <input name='cognome' type='text' required/></h3>");
      out.println("<h3>Facoltà: <input name='facolta' type='text' required/></h3>");
      out.println("<h3><input name='action' type='submit' value='inserisciStudente' /></h3>");
      out.println("</form>");
      out.println("</body></html>");
    }
  }


  protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
    PrintWriter out = response.getWriter();
    out.println("<html><head><title>Studenti</title></head><body>");  

    switch(request.getParameter("action")){
      case "inserisciStudente" : {
        try{
          String sql = "INSERT INTO studenti (nome,cognome,facolta) VALUES(?,?,?)";
          PreparedStatement preparedStatement = dbConnection.prepareStatement(sql);
          preparedStatement.setString(1, request.getParameter("nome"));
          preparedStatement.setString(2, request.getParameter("cognome"));
          preparedStatement.setString(3, request.getParameter("facolta"));
          preparedStatement.executeUpdate();
          preparedStatement.close();
        }catch(SQLException e){e.printStackTrace();}

        response.sendRedirect("/studenti");

      }break;
      
      case "deleteEsame" : {
        try{
          String sql = "DELETE FROM esami WHERE codice=?";
          PreparedStatement preparedStatement = dbConnection.prepareStatement(sql);
          preparedStatement.setString(1, request.getParameter("codice"));
          preparedStatement.executeUpdate();
          preparedStatement.close();
        }catch(SQLException e){e.printStackTrace();}

        response.sendRedirect("/studenti?matricola="+request.getParameter("matricola"));

      }break;

      case "updateEsame" : {
        try{
          String sql = "UPDATE esami SET nome=?, voto=? WHERE codice=?";
          PreparedStatement preparedStatement = dbConnection.prepareStatement(sql);
          preparedStatement.setString(1, request.getParameter("nome"));
          preparedStatement.setString(2, request.getParameter("voto"));
          preparedStatement.setString(3, request.getParameter("matricola"));
          preparedStatement.executeUpdate();
          preparedStatement.close();
        }catch(SQLException e){e.printStackTrace();}

        response.sendRedirect("/studenti?matricola="+request.getParameter("matricola"));

      }break;

      case "insertEsame" : {
        try{
          String sql = "INSERT INTO esami (nome,voto,studente) WHERE codice=?";
          PreparedStatement preparedStatement = dbConnection.prepareStatement(sql);
          preparedStatement.setString(1, request.getParameter("nome"));
          preparedStatement.setString(2, request.getParameter("voto"));
          preparedStatement.setString(3, request.getParameter("matricola"));
          preparedStatement.setString(3, request.getParameter("codice"));
          preparedStatement.executeUpdate();
          preparedStatement.close();
        }catch(SQLException e){e.printStackTrace();}

        response.sendRedirect("/studenti?matricola="+request.getParameter("matricola"));

      }break;
    }

    out.println("</body></html>");
  }

}
