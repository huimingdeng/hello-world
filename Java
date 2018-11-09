import java.util.Arrays;

public class Hello {

	public static void main(String[] args) {
		int[] arr = decompose(30);
		System.out.println(Arrays.toString(arr));
	}

	public static int[] decompose(int base){
		int i = 0;
		// ArrayList<Integer> dec[] = new ArrayList<Integer>();
		int[] dec = new int[10];
		for (int x=2; x <= base; x++) { 
			if(base%x == 0){
				while ( base%x == 0 ) {
					base = base/x;
					dec[i] = x;
					i++;
				}
			}else{
				continue;
			}
		}
		return dec;
	}
}