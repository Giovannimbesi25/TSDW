import java.io.*;
import java.net.*;


public class Client {

  private static final int PORT = 7777;
  public static void main(String[] args){

    InetAddress addr;
    try{
      if(args.length == 0) addr = InetAddress.getByName(null);
      else addr =  InetAddress.getByName(args[0]);
    }catch(UnknownHostException e){
      System.out.println("Invalid host");
      return; 
    }
    Socket socket = null;
    BufferedReader in = null;
    BufferedReader stdin = null;
    PrintWriter out = null;
    try{
      socket = new Socket(addr, PORT);
      in = new BufferedReader(new InputStreamReader(socket.getInputStream()));
      stdin = new BufferedReader(new InputStreamReader(System.in));
      out = new PrintWriter(socket.getOutputStream(), true);

      System.out.println("Client: starting "+socket);

      String clientInput;
      String response;
      try{
        clientInput = stdin.readLine();
        clientInput += "\n";
        out.println(clientInput);
        response = in.readLine();
        System.out.println("Received "+ response);
      }catch(IOException e){
        e.printStackTrace();
      }
    }catch(IOException e){
      e.printStackTrace();
    }

    try{
      socket.close();
      in.close();
      out.close();
      stdin.close();
    }catch(IOException e){
      e.printStackTrace();
    }
  }
}
