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

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;

public class MainActivity extends AppCompatActivity {

    EditText userName,disp,car,mobile,pass,cPass,email;

    String urlParameters;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);


       userName= (EditText) findViewById(R.id.username);
        disp= (EditText) findViewById(R.id.displayName);

        car= (EditText) findViewById(R.id.car);

        mobile= (EditText) findViewById(R.id.mobile);

        pass= (EditText) findViewById(R.id.password);

        cPass= (EditText) findViewById(R.id.cPassword);

        email= (EditText) findViewById(R.id.email);


        Button reg= (Button) findViewById(R.id.reg);

        assert reg != null;
        reg.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                if(userName.getText().toString().isEmpty() || disp.getText().toString().isEmpty() ||
                        car.getText().toString().isEmpty() || mobile.getText().toString().isEmpty() || pass.getText().toString().isEmpty()
                        || cPass.getText().toString().isEmpty() || email.getText().toString().isEmpty()
                        ){

                    Toast.makeText(MainActivity.this,"Please fill all the entries",Toast.LENGTH_LONG).show();



                }else if (pass.getText().toString().equals(cPass.getText().toString())){


               urlParameters="user="+userName.getText().toString()+"&display="+disp.getText().toString()+"&car="+car.getText().toString()+
                       "&mobile="+mobile.getText().toString()+"&pass="+pass.getText().toString()+"&email="+email.getText().toString();


                      new SignUpPres().execute();







                }


            }
        });







    }







    private class SignUpPres extends AsyncTask<String,String,String> {

        String myData="123";
        @Override
        protected void onPreExecute() {
            super.onPreExecute();


        }

        @Override
        protected String doInBackground(String... params) {

            try {
                URL url=new URL("http://parkalert.xyz/loginportal/android/register.php");



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
                Log.e("piyush", myData);


            } catch (MalformedURLException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            }


            return myData;
        }

        @Override
        protected void onPostExecute(String s) {
            super.onPostExecute(s);
            if((s.equals("1"))) {

                SharedPreferences sharedPreferences=getSharedPreferences("piyush",MODE_PRIVATE);
                SharedPreferences.Editor editor = sharedPreferences.edit();
                editor.putString("userName",userName.getText().toString());
                editor.putString("Email", email.getText().toString());
                editor.putString("mobile", mobile.getText().toString());
                editor.putString("car", car.getText().toString());
                editor.putString("password",pass.getText().toString());
                editor.apply();

                Intent in = new Intent(MainActivity.this,HomeActivity.class);
                startActivity(in);
                finish();


            }else{
                Toast.makeText(MainActivity.this,"Registration did not complete TRY again And choose unique user name.",Toast.LENGTH_LONG).show();
            }


        }
    }











}
