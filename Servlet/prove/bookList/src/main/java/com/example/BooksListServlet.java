package com.example;

import jakarta.servlet.ServletException;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;
import java.util.*;
import java.io.IOException;
import java.io.PrintWriter;

public class BooksListServlet extends HttpServlet {

    private List<Book> bookList = new ArrayList<Book>();

    public void init() throws ServletException {
        bookList = new ArrayList<>();
        bookList.add(new Book("The Great Gatsby", "F. Scott Fitzgerald", "Fiction", "1925"));
        bookList.add(new Book("To Kill a Mockingbird", "Harper Lee", "Classics", "1960"));
        bookList.add(new Book("1984", "George Orwell", "Dystopian", "1949"));
    }

    protected void doGet(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
        resp.setContentType("text/html");
        PrintWriter out = resp.getWriter();
        out.println("<html><body>");
        out.println("<h2>Benvenuto nella tua libreria</h2>");
        out.println("<ul>");
        if(bookList==null || bookList.isEmpty()){
            out.println("<h2>Nessun libro presente</h2>");
        }else{
            out.println("<ul>");
            for (Book book : bookList) {
                out.println("<li>" + 
                "Title: " + book.getTitle() + "<br>" + 
                "Author: " + book.getAuthor() + "<br>" + 
                "Type: " + book.getType() + "<br>" + 
                "Year: " + book.getYear() + "<br>");
                out.println("</li><br><br>");
            }
    
            out.println("</ul>");
        }


        out.println("<br><br><h2>Aggiungi un nuovo libro</h2>");
        out.println("<form method=\"post\">");
        out.println("Title: <input name=\"title\" type=\"text\" required /><br>");
        out.println("Author: <input name=\"author\" type=\"text\" required /><br>");
        out.println("Type: <input name=\"type\" type=\"text\" required /><br>");
        out.println("Year: <input name=\"year\" type=\"text\" required /><br>");
        out.println("<input value=\"Inserisci\" type=\"submit\" />");
        out.println("</form>");

        out.println("</body></html>");
    }

    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException{
        String title = request.getParameter("title");
        String author = request.getParameter("author");
        String type = request.getParameter("type");
        String year = request.getParameter("year");
        
        Book book = new Book(title, author, type, year);

        bookList.add(book);

        response.sendRedirect(request.getContextPath() +  "/books");
    }
}

