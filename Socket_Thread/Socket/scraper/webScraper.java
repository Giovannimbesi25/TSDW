import java.net.*;
import java.io.*;

public class webScraper {
  public static void main(String[] args){
    
    if(args.length < 2){
      System.out.println("Usage: webScraper <server> <path>");
      System.exit(1);
    }
    
    String server = args[0];
    String path = args[1];

    System.out.println("Loading contents from "+ server + path);
    
    try{
      Socket socket = new Socket(server, 80);

      PrintStream out = new PrintStream(socket.getOutputStream());
      BufferedReader in = new BufferedReader(new InputStreamReader(socket.getInputStream()));

      // Follow the HTTP protocol of GET <path> HTTP/1.1

      System.out.print( "GET " + path + " HTTP/1.1\r\n" );
      out.print( "GET " + path + " HTTP/1.1\r\n" );

      System.out.print( "Host: " + server+"\r\n");
      out.print( "Host: " + server+"\r\n");
      out.print("\r\n");
      System.out.println( "Get Response");

      String line = in.readLine();
      while( line != null ){
          System.out.println( line );
          line = in.readLine();
      }

      // Close our streams
      in.close();
      out.close();
      socket.close();
    }
    catch( Exception e ){
        e.printStackTrace();
    }
  } 
}
