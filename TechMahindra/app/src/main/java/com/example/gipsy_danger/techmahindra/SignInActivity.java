package com.example.gipsy_danger.techmahindra;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;

public class SignInActivity extends AppCompatActivity {

    String urlParameters;
     EditText userName, pass;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sign_in);




        SharedPreferences sharedPreferences=getSharedPreferences("piyush",MODE_PRIVATE);
        String us=sharedPreferences.getString("userName","0");

        String pa=sharedPreferences.getString("password","0");
        Log.e("user name",us);
        Log.e("pass",pa);
        if(!(us.equals("0") || pa.equals("0"))){
            Intent in = new Intent(SignInActivity.this, HomeActivity.class);
            startActivity(in);
            finish();
        }

        userName= (EditText) findViewById(R.id.logUser);
         pass= (EditText) findViewById(R.id.logPass);

        Button btn= (Button) findViewById(R.id.signbutton);

        assert btn != null;
        btn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (!(userName.getText().toString().isEmpty() || pass.getText().toString().isEmpty())){
                 urlParameters="user="+userName.getText().toString()+"&pass="+pass.getText().toString();

                    Log.e("button","button is clicked");

                    new SignUpPres().execute();

                }
                else {
                    Toast.makeText(SignInActivity.this,"please fill all the entries",Toast.LENGTH_LONG).show();
                }
            }
        });


        Button reg= (Button) findViewById(R.id.register);
        assert reg != null;
        reg.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent in=new Intent(SignInActivity.this,MainActivity.class);
                startActivity(in);

            }
        });

    }


    private class SignUpPres extends AsyncTask<String,String,String> {

        String myData="123";
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
          Log.e("kjsdnf","jhbdc");

        }

        @Override
        protected String doInBackground(String... params) {

            try {
                URL url=new URL("http://parkalert.xyz/loginportal/android/login.php");



                HttpURLConnection connection= (HttpURLConnection) url.openConnection();


                // set connection output to true
                connection.setDoOutput(true);
                connection.setDoInput(true);



                connection.setRequestMethod("POST");
                //    connection.addRequestProperty("Cache-Control", "only-if-cached");
                OutputStreamWriter writer = new OutputStreamWriter(
                        connection.getOutputStream());


                writer.write(urlParameters);

                writer.close();




                InputStream is=connection.getInputStream();
                BufferedReader bufferedReader=new BufferedReader(new InputStreamReader(is,"iso-8859-1"),8);
                StringBuffer strbuilder=new StringBuffer();
                String line=null;
                while((line=bufferedReader.readLine())!=null){///errror hre
                    strbuilder.append(line);
                }
                myData=strbuilder.toString();
                Log.e("piyush Signi n", myData);


            } catch (MalformedURLException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            }

            SharedPreferences sharedPreferences=getSharedPreferences("piyush",MODE_PRIVATE);
            SharedPreferences.Editor editor = sharedPreferences.edit();
            if (myData != null) {
                try {
                    //  JSONObject jsonObj = new JSONObject(myData);



                    JSONArray hospital = new JSONArray(myData);


                    // looping through All Contacts
                    for (int i = 0; i < hospital.length(); i++) {
                        JSONObject c = hospital.getJSONObject(i);

                        editor.putString("userName",c.getString("display"));
                        editor.putString("Email", c.getString("email"));
                        editor.putString("mobile", c.getString("mobile"));
                        editor.putString("car", c.getString("car"));
                        editor.apply();

                       Log.e("data","data is saved");

                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }catch (ArrayIndexOutOfBoundsException e){

                }
            } else {
                Log.e("ServiceHandler", "Couldn't get any data from the url");
            }


            return myData;
        }

        @Override
        protected void onPostExecute(String s) {
            super.onPostExecute(s);
            if(!(s.equals("0"))) {

                SharedPreferences sharedPreferences=getSharedPreferences("piyush",MODE_PRIVATE);
                SharedPreferences.Editor editor = sharedPreferences.edit();
                editor.putString("userName",userName.getText().toString());
                editor.putString("password",pass.getText().toString());
                editor.apply();


                Intent in = new Intent(SignInActivity.this, HomeActivity.class);
                startActivity(in);
                finish();

            }else{
                Toast.makeText(SignInActivity.this,"Please enter valid user name and password",Toast.LENGTH_LONG).show();
            }


        }
    }

}
