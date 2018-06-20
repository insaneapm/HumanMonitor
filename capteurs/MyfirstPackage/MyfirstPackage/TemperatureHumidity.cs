using Constellation.Package;
using System;

namespace MyFirstPackage
{
    [StateObject]
    public class TemperatureHumidity
    {
        public double Temperature { get; set; }
        public int Humidity { get; set; }
    }
}