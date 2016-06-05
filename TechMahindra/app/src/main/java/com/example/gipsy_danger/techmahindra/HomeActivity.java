package com.example.gipsy_danger.techmahindra;

import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.ListViewCompat;
import android.text.Html;
import android.util.Log;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.TextView;

public class HomeActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);






        ImageView park= (ImageView) findViewById(R.id.park);
        ImageView comm= (ImageView) findViewById(R.id.commun);
        ImageView resource= (ImageView) findViewById(R.id.resource);
        assert park != null;
        park.setScaleType(ImageView.ScaleType.FIT_XY);
        assert comm != null;
        comm.setScaleType(ImageView.ScaleType.FIT_XY);
        assert resource != null;
        resource.setScaleType(ImageView.ScaleType.FIT_XY);


        park.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent in=new Intent(HomeActivity.this,ParkActivity.class);
                startActivity(in);
            }
        });

        comm.setOnClickListener(new View.OnClickListener() {
          @Override
          public void onClick(View v) {

              Intent in =new Intent(HomeActivity.this,ResourceActivity.class);
              startActivity(in);
          }
      });

        resource.setOnClickListener(new View.OnClickListener() {
        @Override
        public void onClick(View v) {

            Intent in =new Intent(HomeActivity.this,ResourceActivity.class);
            startActivity(in);

        }
    });





    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        MenuInflater inflater = getMenuInflater();
        inflater.inflate(R.menu.menu_home, menu);

        return super.onCreateOptionsMenu(menu);
    }
    @Override
    public boolean onOptionsItemSelected(MenuItem item) {

        super.onOptionsItemSelected(item);

        Log.e("item","selected");
        SharedPreferences   sharedPreferences=getSharedPreferences("piyush", Context.MODE_PRIVATE);

        switch(item.getItemId()){
            case R.id.action_settings:

                SharedPreferences.Editor editor=sharedPreferences.edit();
                editor.clear();
                editor.apply();
                Intent in=new Intent(this, SignInActivity.class);
                startActivity(in);
                finish();
                break;

            case R.id.profile:

                String us=sharedPreferences.getString("userName","0");
                String mob=sharedPreferences.getString("mobile","0");
                String car=sharedPreferences.getString("car","0");

                showAlertDialog("User's Profile",us+"\nMobile:-"+mob+"\nCar number:-"+car);

                break;

        }
        return true;

    }

    public void showAlertDialog(final String title, String message) {
        //  AlertDialog.Builder alertDialog = new AlertDialog.Builder(context).create();
        AlertDialog.Builder alertDialog = new AlertDialog.Builder(HomeActivity.this);
        // Setting Dialog Title
        alertDialog.setTitle(title);
        alertDialog.setIcon(R.drawable.logo);

        // Setting Dialog Message

            alertDialog.setMessage(message);


        alertDialog.setPositiveButton("Ok",
                new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog,int id) {
                        if(title.equals("If Yes")){


                            dialog.cancel();
                        }
                    }
                });


        alertDialog.show();
    }

}
