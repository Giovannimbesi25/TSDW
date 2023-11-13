
public class prova {
  public static void main(String[] args){
    String str = "1234";
    int num = 0;

    for(int i = 0; i< str.length(); i++){
      num += Character.getNumericValue(str.charAt(i));
    }
    System.out.println(num);

    StringBuilder stringBuilder = new StringBuilder("dioporco");

    stringBuilder.reverse();

    System.out.println(stringBuilder.toString());

  } 
}
