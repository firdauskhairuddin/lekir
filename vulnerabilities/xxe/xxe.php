<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Car Details Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #1a2a3a, #0d1520);
            color: #333;
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .header {
            text-align: center;
            margin-bottom: 40px;
            padding: 30px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            position: relative;
            overflow: hidden;
        }
        
        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #ff6b6b, #4ecdc4, #45b7d1);
        }
        
        .header h1 {
            color: #2c3e50;
            font-size: 2.8rem;
            margin-bottom: 10px;
            background: linear-gradient(90deg, #3498db, #2ecc71);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .header p {
            color: #7f8c8d;
            font-size: 1.2rem;
            max-width: 800px;
            margin: 0 auto;
            line-height: 1.6;
        }
        
        .app-container {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
        }
        
        .input-section {
            flex: 1;
            min-width: 300px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        
        .output-section {
            flex: 1;
            min-width: 300px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        
        .section-title {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #eee;
        }
        
        .section-title i {
            font-size: 1.8rem;
            color: #3498db;
        }
        
        .section-title h2 {
            color: #2c3e50;
            font-size: 1.8rem;
        }
        
        .input-group {
            margin-bottom: 25px;
        }
        
        label {
            display: block;
            margin-bottom: 10px;
            color: #2c3e50;
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        textarea {
            width: 100%;
            padding: 20px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 16px;
            resize: vertical;
            min-height: 300px;
            transition: all 0.3s;
            line-height: 1.5;
            font-family: 'Courier New', monospace;
            background: #fafafa;
        }
        
        textarea:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
            background: #fff;
        }
        
        .btn-submit {
            background: linear-gradient(90deg, #3498db, #2980b9);
            color: white;
            border: none;
            padding: 18px 40px;
            font-size: 1.2rem;
            font-weight: 600;
            border-radius: 12px;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            letter-spacing: 1px;
        }
        
        .btn-submit:hover {
            background: linear-gradient(90deg, #2980b9, #1f6391);
            transform: translateY(-3px);
            box-shadow: 0 7px 20px rgba(52, 152, 219, 0.4);
        }
        
        .btn-submit:active {
            transform: translateY(-1px);
        }
        
        .result-container {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 25px;
            min-height: 300px;
            border: 2px dashed #dee2e6;
        }
        
        .result-placeholder {
            text-align: center;
            color: #adb5bd;
            padding: 60px 20px;
        }
        
        .result-placeholder i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }
        
        .result-placeholder h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #6c757d;
        }
        
        .car-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        
        .detail-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            border-left: 5px solid #3498db;
            transition: transform 0.3s;
        }
        
        .detail-card:hover {
            transform: translateY(-5px);
        }
        
        .detail-title {
            color: #7f8c8d;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }
        
        .detail-value {
            color: #2c3e50;
            font-size: 1.3rem;
            font-weight: 600;
        }
        
        .example-section {
            margin-top: 30px;
            background: #e8f4fc;
            border-radius: 12px;
            padding: 20px;
        }
        
        .example-title {
            color: #3498db;
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .example-code {
            background: #2c3e50;
            color: #ecf0f1;
            padding: 15px;
            border-radius: 8px;
            font-family: 'Courier New', monospace;
            font-size: 14px;
            line-height: 1.5;
            overflow-x: auto;
        }
        
        .footer {
            text-align: center;
            margin-top: 50px;
            color: #bdc3c7;
            font-size: 0.9rem;
            padding: 20px;
        }
        
        @media (max-width: 768px) {
            .app-container {
                flex-direction: column;
            }
            
            .header h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-car"></i> Luxury Car Details Portal</h1>
            <p>Enter XML data with car information to get beautifully formatted details. Our system processes your car data and displays it in an organized layout.</p>
        </div>
        
        <div class="app-container">
            <div class="input-section">
                <div class="section-title">
                    <i class="fas fa-code"></i>
                    <h2>Enter Car XML Data</h2>
                </div>
                
                <form method="POST" action="">
                    <div class="input-group">
                        <label for="car-xml"><i class="fas fa-file-code"></i> Car Details in XML Format</label>
                        <textarea id="car-xml" name="car-xml" placeholder='Paste your car XML data here...'><?php
                            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['car-xml'])) {
                                echo htmlspecialchars($_POST['car-xml']);
                            } else {
                                echo '<?xml version="1.0"?>
<car>
    <brand>Toyota</brand>
    <model>Camry XSE</model>
    <year>2024</year>
    <color>Midnight Black Metallic</color>
    <price>34999</price>
    <engine>2.5L 4-Cylinder Hybrid</engine>
    <horsepower>208 HP</horsepower>
    <fuel_economy>44 MPG Combined</fuel_economy>
    <transmission>8-Speed Automatic</transmission>
    <features>
        <feature>Panoramic Sunroof</feature>
        <feature>Heated Leather Seats</feature>
        <feature>12.3" Touchscreen Display</feature>
        <feature>JBL Premium Audio</feature>
        <feature>Advanced Safety Suite</feature>
    </features>
    <description>The 2024 Toyota Camry XSE combines sophisticated styling with impressive fuel efficiency and advanced technology features.</description>
</car>';
                            }
                        ?></textarea>
                    </div>
                    
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-cogs"></i> Process Car Details
                    </button>
                </form>
                
                <div class="example-section">
                    <div class="example-title">
                        <i class="fas fa-lightbulb"></i> Example XML Format
                    </div>
                    <div class="example-code">
&lt;?xml version="1.0"?&gt;
&lt;car&gt;
    &lt;brand&gt;Car Brand Here&lt;/brand&gt;
    &lt;model&gt;Model Name&lt;/model&gt;
    &lt;year&gt;2024&lt;/year&gt;
    &lt;color&gt;Color Name&lt;/color&gt;
    &lt;price&gt;Price in USD&lt;/price&gt;
    &lt;engine&gt;Engine Details&lt;/engine&gt;
    &lt;features&gt;Optional features list&lt;/features&gt;
&lt;/car&gt;
                    </div>
                </div>
            </div>
            
            <div class="output-section">
                <div class="section-title">
                    <i class="fas fa-list-alt"></i>
                    <h2>Car Details Output</h2>
                </div>
                
                <div class="result-container">
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['car-xml'])) {
                        $xmlData = $_POST['car-xml'];
                        
                        if (!empty($xmlData)) {
                            try {
                                // Process the XML data
                                //libxml_disable_entity_loader(false);

                                $carData = simplexml_load_string(
                                    $xmlData,
                                    'SimpleXMLElement',
                                    LIBXML_NOENT | LIBXML_DTDLOAD
                                );
                                
                                if ($carData) {
                                    echo '<div class="car-details">';
                                    
                                    // Function to display detail card
                                    function displayDetail($title, $value) {
                                        if (!empty($value)) {
                                            return '<div class="detail-card">
                                                <div class="detail-title">' . htmlspecialchars($title) . '</div>
                                                <div class="detail-value">' . htmlspecialchars($value) . '</div>
                                            </div>';
                                        }
                                        return '';
                                    }
                                    
                                    // Display all available car details
                                    echo displayDetail('Brand', (string)$carData->brand);
                                    echo displayDetail('Model', (string)$carData->model);
                                    echo displayDetail('Year', (string)$carData->year);
                                    echo displayDetail('Color', (string)$carData->color);
                                    echo displayDetail('Price', '$' . number_format((float)$carData->price, 2));
                                    echo displayDetail('Engine', (string)$carData->engine);
                                    echo displayDetail('Horsepower', (string)$carData->horsepower);
                                    echo displayDetail('Transmission', (string)$carData->transmission);
                                    echo displayDetail('Fuel Economy', (string)$carData->fuel_economy);
                                    echo displayDetail('VIN', (string)$carData->vin);
                                    echo displayDetail('Mileage', (string)$carData->mileage);
                                    
                                    // Handle features specially if they're in a list
                                    if (isset($carData->features)) {
                                        $features = '';
                                        if (isset($carData->features->feature)) {
                                            foreach ($carData->features->feature as $feature) {
                                                $features .= '• ' . htmlspecialchars((string)$feature) . '<br>';
                                            }
                                        } else {
                                            $features = (string)$carData->features;
                                        }
                                        
                                        if (!empty($features)) {
                                            echo '<div class="detail-card" style="grid-column: span 2;">
                                                <div class="detail-title">Features</div>
                                                <div class="detail-value">' . $features . '</div>
                                            </div>';
                                        }
                                    }
                                    
                                    // Handle description specially
                                    if (isset($carData->description)) {
                                        echo '<div class="detail-card" style="grid-column: span 2; border-left-color: #2ecc71;">
                                            <div class="detail-title">Description</div>
                                            <div class="detail-value">' . htmlspecialchars((string)$carData->description) . '</div>
                                        </div>';
                                    }
                                    
                                    echo '</div>';
                                } else {
                                    echo '<div class="result-placeholder">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        <h3>Invalid XML Format</h3>
                                        <p>Please check your XML syntax and try again.</p>
                                    </div>';
                                }
                                
                            } catch (Exception $e) {
                                echo '<div class="result-placeholder">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <h3>Processing Error</h3>
                                    <p>Error: ' . htmlspecialchars($e->getMessage()) . '</p>
                                </div>';
                            }
                        } else {
                            echo '<div class="result-placeholder">
                                <i class="fas fa-car"></i>
                                <h3>No Data Provided</h3>
                                <p>Please enter XML car data in the input section and click "Process Car Details".</p>
                            </div>';
                        }
                    } else {
                        echo '<div class="result-placeholder">
                            <i class="fas fa-arrow-left"></i>
                            <h3>Awaiting Input</h3>
                            <p>Enter your car XML data on the left and click "Process Car Details" to see the formatted results here.</p>
                        </div>';
                    }
                    ?>
                </div>
                
                <div class="example-section">
                    <div class="example-title">
                        <i class="fas fa-info-circle"></i>
                        <h3>How It Works</h3>
                    </div>
                    <p style="color: #555; line-height: 1.6;">
                        1. Enter valid XML data with car information in the left panel.<br>
                        2. Click "Process Car Details" to parse and display the information.<br>
                        3. View beautifully formatted car details in the right panel.<br>
                        4. All data is processed securely and displayed in an organized layout.
                    </p>
                </div>
            </div>
        </div>
        
        <div class="footer">
            <p><i class="far fa-copyright"></i> 2026 Luxury Car Details Portal | XML Data Processor</p>
            <p style="margin-top: 5px; font-size: 0.8rem;">Supports all standard car information fields in XML format</p>
        </div>
    </div>
</body>
</html>
