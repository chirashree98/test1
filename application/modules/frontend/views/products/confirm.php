<!DOCTYPE html>
<html>

<head>
    <?php $this->load->view('common/header'); ?>
    <style>
        #artist,
        #member,
        #member_by_role,
        #virtual_studio_sec,
        #products_types,
        #design_store,
        #servicesec {
            display: none;
        }

        .loader {
            border: 16px solid #f3f3f3;
            /* Light grey */
            border-top: 16px solid #3498db;
            /* Blue */
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

    </style>
</head>

<body>
    




    <section id="my-cart">
        <div class="custom-width">
            <div class="page-heading">
              
            </div>

      <p>  Thanks For Submit</p>

</html>

 </head>
 <body>
   <?php $this->load->view('common/footer'); ?>
    <?php $this->load->view('common/footer_js'); ?>

 </body>
</html>
